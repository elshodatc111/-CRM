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
            'amount.required'      => 'Daromad summasini kiritish majburiy.',
            'amount.numeric'       => 'Summa faqat raqamlardan iborat bo\'lishi kerak.',
            'amount.gt'            => 'Daromad summasi 0 dan katta bo\'lishi kerak.',
            'amount_type.required' => 'Daromad turini tanlang.',
            'amount_type.in'       => 'Tanlangan daromad turi noto\'g\'ri.',
            'description.required' => 'Daromad haqida izoh qoldiring.',
        ];
    }
    
}
