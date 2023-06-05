<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAdminRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function registerView() {
        $adminsCount = count(Admin::all());
        if ($adminsCount > 0) {
            return redirect()->route('admin.login')->with('error', 'Seul le premier administrateur est autorisé à s\'inscrire, veuillez vous connecter.');
        }

        return view('auth.admin.register');
    }




    
    public function register(RegisterAdminRequest $request) {
        $request->validate($request->rules());

        $adminsCount = count(Admin::all());
        if ($adminsCount > 0) {
            return redirect()->route('admin.login')->with('error', 'Seul le premier administrateur est autorisé à s\'inscrire, veuillez vous connecter.');
        }

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
        return view('auth.admin.login');
    }

    public function login(LoginAdminRequest $request) {
        // * code:
        $request->validate($request->rules());

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->back()->with('error', 'Votre identifiant est invalide !');
        }
    }

    public function logout() {
        Auth::guard('admin')->logout();

        return redirect('/')->with('success', 'Vous avez réussi à vous déconnecter !');
    }
}
