<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest{
    
    public function authorize(): bool{
        return true;
    }
    
    protected function prepareForValidation(){
        $this->merge([
            'salary' => $this->salary ? preg_replace('/\s+/', '', $this->salary) : null,
            'phone' => $this->phone ? preg_replace('/[^0-9]/', '', $this->phone) : null,
            'phone_two' => $this->phone_two ? preg_replace('/[^0-9]/', '', $this->phone_two) : null,
        ]);
    }

    public function rules(): array{
        return [
            'user_id'   => 'required|exists:users,id',
            'name'      => 'required|string|max:255|min:3',
            'phone'     => 'required|string|max:20',
            'phone_two' => 'nullable|string|max:20',
            'addres'    => 'required|string|max:500',
            'salary'    => 'required|numeric|min:0',
            'tkun'      => 'required',
            'pasport'   => 'required|string|max:20',
            'role'      => 'required|in:direktor,admin,tarbiyachi,yordamchi,teacher,oshpaz,farrosh,xodim',
            'about'     => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'salary.numeric' => __('emploes_page.salary_numeric'),
            'tkun.before'    => __('emploes_page.tkun_before'),
            'role.in'        => __('emploes_page.role_in'),
            'user_id.exists' => __('emploes_page.user_id_exists'),
        ];
    }
}
