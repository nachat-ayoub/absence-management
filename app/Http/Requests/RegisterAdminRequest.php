<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterAdminRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'nom' => 'required|string|min:3|max:255',
            'prenom' => 'required|string|min:3|max:255',
            'email' => 'required|email|string|max:255|unique:admins,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
