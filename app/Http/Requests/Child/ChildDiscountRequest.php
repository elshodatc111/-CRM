<?php

namespace App\Http\Requests\Child;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChildDiscountRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    protected function prepareForValidation(): void{
        if ($this->has('amount')) {
            $this->merge([
                'amount' => str_replace(' ', '', $this->amount),
            ]);
        }
    }

    public function rules(): array{
        return [
            'child_id' => 'required|exists:children,id',
            'amount' => 'required|numeric|min:0',
            'start_comment' => 'required|string|max:1000',
        ];
    }
    public function messages(): array{
        return [
            'amount.numeric' => 'Chegirma summasi faqat raqamlardan iborat bo\'lishi kerak.',
            'amount.required' => 'Chegirma summasini kiritish majburiy.',
            'start_comment.required' => 'Izoh qoldirish majburiy.',
        ];
    }
}
