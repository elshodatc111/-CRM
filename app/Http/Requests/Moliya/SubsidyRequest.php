<?php

namespace App\Http\Requests\Moliya;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SubsidyRequest extends FormRequest{

    public function authorize(): bool{
        return true; 
    }

    protected function prepareForValidation(): void{
        if ($this->filled('amount')) {
            $this->merge([
                'amount' => str_replace(' ', '', $this->amount),
            ]);
        }
    }
    
    public function rules(): array{
        return [
            'amount'      => 'required|numeric|gt:0',
            'description' => 'required|string|max:1500',
        ];
    }
    
    public function messages(): array{
        return [
            'amount.required'      => __('moliya.amount_c_required'),
            'amount.numeric'       => __('moliya.amount_c_numeric'),
            'amount.gt'            => __('moliya.amount_c_gt'),
            'description.required' => __('moliya.description_c_required'),
        ];
    }
    
}
