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
            'amount.required'    => __('child_show.amount_2_required'),
            'amount.numeric'     => __('child_show.amount_2_numeric'),
            'amount.gt'          => __('child_show.amount_2_gt'),
            'amount_type.required' => __('child_show.amount_type_2_required'),
            'description.required' => __('child_show.description_2_required'),
        ];
    } 

}
