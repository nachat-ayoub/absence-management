<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormateurRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function loginView() {
        return view('auth.formateur.login');
    }

    public function login(LoginFormateurRequest $request) {
        $request->validate($request->rules());

        if (Auth::guard('formateur')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('formateur.dashboard');
        } else {
            return redirect()->back()->with('error', 'Your Credintal is invalid');
        }
    }

    public function logout() {
        Auth::guard('formateur')->logout();

        return redirect('/')->with('success', 'You Have Logout Success');
    }
}
