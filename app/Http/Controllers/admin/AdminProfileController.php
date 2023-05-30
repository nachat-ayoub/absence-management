<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdminProfileController extends Controller {
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse{
        $admin = $request->user('admin');

        if (!$admin) {
            abort(404);
        }

        $adminData = $request->validated();

        Admin::find($admin->id)->update($adminData);

        return redirect()->route('admin.profile.edit')->with('status', 'profile-updated');
    }

    public function updatePassword(Request $request): RedirectResponse{
        $admin = $request->user('admin');

        if (!$admin) {
            abort(404);
        }

        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::guard('admin')->user()->password)) {
                        $fail('Le mot de passe actuel est incorrect.');
                    }
                },
            ],

            'password' => ['required', Password::defaults(), 'confirmed'],

        ]);

        $admin->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse{
        $request->validateWithBag('userDeletion', [
            'password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::guard('admin')->user()->password)) {
                    $fail('Le mot de passe actuel est incorrect.');
                }
            }],
        ]);

        $admin = $request->user('admin');
        Auth::guard('admin')->logout();
        $admin->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
