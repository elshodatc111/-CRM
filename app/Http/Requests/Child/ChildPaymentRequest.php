<?php

namespace App\Http\Requests\Child;

use Illuminate\Foundation\Http\FormRequest;

class ChildPaymentRequest extends FormRequest{

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
            'child_id'    => 'required|exists:children,id',
            'amount'      => 'required|numeric|gt:0',
            'amount_type' => 'required|in:cash,card,bank',
            'description' => 'required|string|max:500',
        ];
    }

    public function messages(): array{
        return [
            'amount.required'    => 'To\'lov summasini kiritish majburiy.',
            'amount.numeric'     => 'To\'lov summasi faqat raqamlardan iborat bo\'lishi kerak.',
            'amount.gt'          => 'To\'lov summasi 0 dan katta bo\'lishi shart.',
            'amount_type.required' => 'To\'lov turini tanlang.',
            'description.required' => 'To\'lov haqida izoh qoldiring.',
        ];
    }

}
