<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array{
        return [
            'current_password.current_password' => __('auth.current_password_current_password'),
            'password.confirmed' => __('auth.password_confirmed'),
            'password.min' => __('auth.password_min'),
        ];
    }
}
