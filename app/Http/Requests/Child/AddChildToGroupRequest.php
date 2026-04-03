<?php

namespace App\Http\Requests\Child;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddChildToGroupRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        return [
            'child_id' => 'required|exists:children,id',
            'group_id' => 'required|exists:groups,id',
        ];
    }
    
    public function messages(): array{
        return [
            'child_id.required' => 'Bola IDsi ko\'rsatilmadi.',
            'child_id.exists'   => 'Bunday bola tizimda mavjud emas.',
            'group_id.required' => 'Iltimos, guruhni tanlang.',
            'group_id.exists'   => 'Tanlangan guruh tizimda topilmadi.',
        ];
    }
}
