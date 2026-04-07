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
            'child_id.required' => __('emploes_show.child_id_4_required'),
            'child_id.exists'   => __('emploes_show.child_id_4_exists'),
            'group_id.required' => __('emploes_show.group_id_4_required'),
            'group_id.exists'   => __('emploes_show.group_id_4_exists'),
        ];
    }
}
 