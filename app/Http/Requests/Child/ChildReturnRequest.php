<?php

namespace App\Http\Requests\Child;

use App\Models\Balans;
use App\Models\Child;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ChildReturnRequest extends FormRequest{

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
            'amount_type' => 'required|in:cash,card,bank',
            'description' => 'required|string|max:1000',
            'amount'      => [
                'required',
                'numeric',
                'gt:0',
                function ($attribute, $value, $fail) {
                    $child = Child::find($this->child_id);
                    if (!$child || $child->balans < $value) {
                        return $fail("Bolaning balansida yetarli mablag' mavjud emas. (Hozirgi balans: " . number_format($child->balans ?? 0, 0, '.', ' ') . " so'm)");
                    }
                    $kassa = Balans::first();
                    $type = $this->amount_type;
                    if (!$kassa || $kassa->$type < $value) {
                        $labels = ['cash' => 'Naqd', 'card' => 'Karta', 'bank' => 'Bank'];
                        return $fail("Kassaning " . $labels[$type] . " hisobida yetarli mablag' mavjud emas.");
                    }
                },
            ],
        ];
    }

    public function messages(): array{
        return [
            'amount.required'      => 'Qaytarish summasini kiritish majburiy.',
            'amount.numeric'       => 'Summa faqat raqamlardan iborat bo\'lishi kerak.',
            'amount.gt'            => 'Summa 0 dan katta bo\'lishi kerak.',
            'amount_type.required' => 'Qaytarish turini tanlang.',
            'description.required' => 'Qaytarish sababini ko\'rsating.',
        ];
    }
}
