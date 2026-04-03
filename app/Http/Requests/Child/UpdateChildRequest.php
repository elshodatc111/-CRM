<?php

namespace App\Http\Requests\Child;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateChildRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    protected function prepareForValidation(): void{
        $this->merge([
            'phone' => $this->phone ? str_replace([' ', '(', ')', '-'], '', $this->phone) : null,
            'phone_two' => $this->phone_two ? str_replace([' ', '(', ')', '-'], '', $this->phone_two) : null,
            'name' => ucwords(mb_strtolower($this->name)),
            'ota_ona' => ucwords(mb_strtolower($this->ota_ona)),
        ]);
    }
    
    public function rules(): array{
        return [
            'child_id'    => 'required|exists:children,id',
            'name'        => 'required|string|max:255',
            'ota_ona'     => 'required|string|max:255',
            'phone'       => 'required|string|min:9|max:20',
            'phone_two'   => 'required|string|min:9|max:20',
            'address'     => 'required|string|max:500',
            'guvohnoma'   => 'required|string|max:50',
            'tkun'        => 'required|date|before:today',
            'jinsi'       => 'required|in:male,female',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'name.required'      => 'Bola FIO kiritilishi shart.',
            'phone.required'     => 'Asosiy telefon raqami shart.',
            'phone.min'          => 'Telefon raqami juda qisqa.',
            'tkun.before'        => 'Tug\'ilgan kun kelajakda bo\'lishi mumkin emas.',
            'jinsi.in'           => 'Jinsni tanlashda xatolik.',
            'child_id.exists'    => 'Bunday bola tizimda topilmadi.',
        ];
    }
}
