<?php

namespace App\Http\Controllers\Formateur;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormateurRequest;

class AuthController extends Controller
{
    public function loginView()
    {
        if (Auth::guard('formateur')) {
            return redirect()->route('formateur.dashboard');
        }
        return view('auth.formateur.login');
    }

    public function login(LoginFormateurRequest $request)
    {
        // * code:
        $request->validate($request->rules());
        if (Auth::guard('formateur')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('formateur.dashboard');
        } else {
            return redirect()->back()->with('error', 'Your Credintal is invalid');
        }
    }

    public function logout()
    {
        Auth::guard('formateur')->logout();

        return redirect('/')->with('success', 'You Have Logout Success');
    }
}