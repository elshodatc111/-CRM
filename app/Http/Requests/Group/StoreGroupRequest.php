<?php

namespace App\Http\Requests\Group;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'group_name'  => 'required|string|max:255',
            'group_price' => 'required|string', 
            'about'       => 'required|string|max:1000',
        ];
    }

    public function attributes(): array{
        return [
            'group_name'  => __('groups.group_name'),
            'group_price' =>  __('groups.group_price'),
            'about'       =>  __('groups.about'),
        ];
    }

    public function messages(): array{
        return [
            'required' => ':attribute '.__('groups.required'),
            'string'   => ':attribute '.__('groups.string'),
            'max'      => ':attribute '.__('groups.max'),
        ];
    }

    protected function passedValidation(): void{
        $this->merge([
            'group_price' => (float) preg_replace('/\s+/', '', $this->group_price),
            'status'      => 'aktiv',
        ]);
    }

}
