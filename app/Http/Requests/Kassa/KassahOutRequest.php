<?php

namespace App\Http\Requests\Kassa;

use App\Models\Kassa;
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
                        $fail(__('kassa.mablag_yetarli_emas'));
                    }
                },
            ],
            'start_comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'amount.required' => __('kassa.amount_2_required'),
            'amount.numeric'  =>  __('kassa.amount_2_numeric'),
            'amount.gt'       =>  __('kassa.amount_2_gt'),
            'start_comment.required' =>  __('kassa.start_comment_2_required'),
        ];
    }
}
