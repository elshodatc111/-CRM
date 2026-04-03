<?php

namespace App\Http\Requests\Moliya;

use App\Models\Balans;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReturnToKassaRequest extends FormRequest{
    
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
            'amount_type' => 'required|in:cash,card,bank',
            'description' => 'required|string|max:1000',
            'amount'      => [
                'required',
                'numeric',
                'gt:0',
                function ($attribute, $value, $fail) {
                    $kassa = Balans::first();
                    $type = $this->amount_type;
                    if (!$kassa || !isset($kassa->$type) || $kassa->$type < $value) {
                        $labels = [
                            'cash' => 'Naqd',
                            'card' => 'Karta',
                            'bank' => 'Bank'
                        ];                        
                        $current_balans = number_format($kassa->$type ?? 0, 0, '.', ' ');
                        $fail("Tanlangan " . $labels[$type] . " hisobida yetarli mablag' mavjud emas. (Hozirgi balans: $current_balans UZS)");
                    }
                },
            ],
        ];
    }

    public function messages(): array{
        return [
            'amount.required'      => 'Qaytarish summasini kiritish majburiy.',
            'amount.numeric'       => 'Summa faqat raqamlardan iborat bo\'lishi kerak.',
            'amount.gt'            => 'Qaytarish summasi 0 dan katta bo\'lishi shart.',
            'amount_type.required' => 'To\'lov turini tanlang.',
            'description.required' => 'Qaytarish haqida izoh qoldiring.',
        ];
    }
}
