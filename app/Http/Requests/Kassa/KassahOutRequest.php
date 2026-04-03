<?php

namespace App\Http\Requests\Kassa;

use App\Models\Kassa;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KassahOutRequest extends FormRequest{

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
            'amount' => [
                'required',
                'numeric',
                'gt:0',
                function ($attribute, $value, $fail) {
                    $kassa = Kassa::getInstance(); 
                    if (!$kassa || $kassa->cash < $value) {
                        $fail("Kassada yetarli mablag' mavjud emas. Joriy balans: " . number_format($kassa->cash ?? 0, 0, '.', ' ') . " UZS");
                    }
                },
            ],
            'start_comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'amount.required' => 'Chiqim summasini kiritish majburiy.',
            'amount.numeric'  => 'Summa faqat raqamlardan iborat bo\'lishi kerak.',
            'amount.gt'       => 'Chiqim summasi 0 dan katta bo\'lishi kerak.',
            'start_comment.required' => 'Chiqim haqida izoh qoldiring.',
        ];
    }
}
