<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use Auth;
use Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller {
    public function registerView() {
        return view('auth.admin.register');
    }

    public function register(RegisterAdminRequest $request) {
        $request->validate($request->rules());

        $admin = Admin::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($admin));
        Auth::login($admin);

        return redirect()->route('admin.dashboard');
    }
    public function loginView() {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin.login');
    }

    public function login(LoginAdminRequest $request) {
        // * code:
        $request->validate($request->rules());

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', 'Your Credintal is invalid');
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();

        return redirect('/')->with('success', 'You Have Logout Success');
    }
}
