<?php

namespace App\Http\Requests\Moliya;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class IncomeRequest extends FormRequest{

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
            'amount'      => 'required|numeric|gt:0', // Faqat musbat raqam
            'amount_type' => 'required|in:cash,card,bank,sub', // Ruxsat etilgan turlar
            'description' => 'required|string|max:1500',
        ];
    }

    public function messages(): array{
        return [
            'amount.required'      => __('moliya.amount_a_required'),
            'amount.numeric'       => __('moliya.amount_a_numeric'),
            'amount.gt'            => __('moliya.amount_a_gt'),
            'amount_type.required' => __('moliya.amount_type_a_required'),
            'amount_type.in'       => __('moliya.amount_type_a_in'),
            'description.required' => __('moliya.description_a_required'),
        ];
    }
    
}
