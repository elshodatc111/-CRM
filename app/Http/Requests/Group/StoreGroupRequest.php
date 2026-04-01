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
            'group_name'  => 'Guruh nomi',
            'group_price' => 'Guruh narxi',
            'about'       => 'Guruh haqida',
        ];
    }

    public function messages(): array{
        return [
            'required' => ':attribute maydonini toʻldirish shart.',
            'string'   => ':attribute matn koʻrinishida boʻlishi kerak.',
            'max'      => ':attribute juda uzun, maksimal :max belgi kiritish mumkin.',
        ];
    }

    protected function passedValidation(): void{
        $this->merge([
            'group_price' => (float) preg_replace('/\s+/', '', $this->group_price),
            'status'      => 'aktiv',
        ]);
    }

}
