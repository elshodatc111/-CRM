<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class EmployeeStoreRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    protected function prepareForValidation(): void{
        $this->merge([
            'name' => Str::upper($this->name),
            'phone' => $this->phone ? str_replace(' ', '', $this->phone) : null,
            'phone_two' => $this->phone_two ? str_replace(' ', '', $this->phone_two) : null,
            'salary' => $this->salary ? str_replace(' ', '', $this->salary) : null,
        ]);
    }

    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:12', Rule::unique('users', 'phone')],
            'phone_two' => ['nullable', 'string', 'min:12'],
            'address' => ['required', 'string'],
            'salary' => ['required', 'numeric', 'min:0'],
            'tkun' => ['required', 'date', 'before:today'],
            'pasport' => ['required', 'string', 'max:20'],
            'role' => [
                'required', 
                Rule::in([
                    'superadmin', 'admin', 'direktor', 'tarbiyachi', 
                    'yordamchi', 'teacher', 'oshpaz', 'farrosh', 'xodim'
                ])
            ],
            'about' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array {
        return [
            'name.required' => __('emploes_page.validation.name_required'),
            'phone.required' => __('emploes_page.validation.phone_required'),
            'phone.unique' => __('emploes_page.validation.phone_unique'),
            'salary.numeric' => __('emploes_page.validation.salary_numeric'),
            'tkun.before' => __('emploes_page.validation.tkun_before'),
            'role.required' => __('emploes_page.validation.role_required'),
        ];
    }
}