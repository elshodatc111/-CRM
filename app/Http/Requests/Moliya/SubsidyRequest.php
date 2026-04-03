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
            'amount.required'      => 'Subsidiya summasini kiritish majburiy.',
            'amount.numeric'       => 'Summa faqat raqamlardan iborat bo\'lishi kerak.',
            'amount.gt'            => 'Subsidiya summasi 0 dan katta bo\'lishi shart.',
            'description.required' => 'Subsidiya haqida qisqacha ma\'lumot yozing.',
        ];
    }
    
}
