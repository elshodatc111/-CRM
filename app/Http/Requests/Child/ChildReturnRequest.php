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
                        return $fail(__('emploes_show.bolaning_balansida_yetarli_mablag_mavjud_emas'));
                    }
                    $kassa = Balans::first();
                    $type = $this->amount_type;
                    if (!$kassa || $kassa->$type < $value) {
                        $labels = ['cash' => 'Naqd', 'card' => 'Karta', 'bank' => 'Bank'];
                        return $fail(__('child_sow.kassa_hisobida_yetarli_mablag_mavjud_emas'));
                    }
                },
            ],
        ];
    }

    public function messages(): array{
        return [
            'amount.required'      => __('child_show.amount_1_required'),
            'amount.numeric'       => __('child_show.amount_1_numeric'),
            'amount.gt'            => __('child_show.amount_1_gt'),
            'amount_type.required' => __('child_show.amount_type_1_required'),
            'description.required' => __('child_show.description_1_required'),
        ];
    }
}
 