<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        return [
            'phone' => [
                'required', 
                'string', 
                'min:12',
                Rule::exists('users', 'phone')->where(function ($query) {
                    return $query->where('status', '!=', 'delete')->whereIn('role', ['superadmin', 'admin', 'direktor']); // Faqat shu rollar kira oladi
                }),
            ],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages(): array{
        return [
            'phone.required' => __('auth.phone_required'),
            'phone.min' => __('auth.phone_format_error'),
            'phone.exists' => __('auth.role_access_denied'), // Rollar mos kelmasa ham shu xabar chiqadi
            'password.required' => __('auth.password_required'),
            'password.min' => __('auth.password_min_error'),
        ];
    }

    protected function prepareForValidation(){
        $cleanedPhone = str_replace([' ', '_', '(', ')', '-'], '', $this->phone);
        $this->merge([
            'phone' => $cleanedPhone,
        ]);
    }

}