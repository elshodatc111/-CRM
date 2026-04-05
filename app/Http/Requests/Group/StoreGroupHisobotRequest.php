<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupHisobotRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    public function rules(): array{
        return [
            'reports' => 'required|array|min:1',
            'reports.*.group_id' => 'required|exists:groups,id',
            'reports.*.is_active' => 'nullable|boolean',
            'reports.*.title' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array{
        return [
            'reports.required' => __('home.reports__required'),
            'reports.*.group_id.exists' => __('home.reports__group_id__exists'),
            'reports.*.title.max' => __('home.reports__title__max'),
        ];
    }
}
