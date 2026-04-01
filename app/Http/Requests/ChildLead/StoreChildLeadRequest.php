<?php

namespace App\Http\Requests\ChildLead;

use Illuminate\Foundation\Http\FormRequest;

class StoreChildLeadRequest extends FormRequest {

    public function authorize(): bool {
        return true;
    }

    public function rules(): array {
        return [
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string',
            'phone_two'   => 'required|string',
            'ota_ona'     => 'required|string|max:255',
            'address'     => 'required|string|max:500',
            'tkun'        => 'required|date|before:today',
            'jinsi'       => 'required|in:male,female',
            'description' => 'required|string|max:1000',
        ];
    }

    public function attributes(): array {
        return [
            'name'      => 'Bolaning F.I.O',
            'phone'     => 'Asosiy telefon',
            'phone_two' => 'Qo\'shimcha telefon',
            'ota_ona'   => 'Ota-onasi ismi',
            'address'   => 'Yashash manzili',
            'tkun'      => 'Tug\'ilgan sanasi',
            'jinsi'     => 'Jinsi',
        ];
    }

    public function messages(): array {
        return [
            'required' => ':attribute maydonini toʻldirish majburiy.',
            'string'   => ':attribute matn koʻrinishida boʻlishi kerak.',
            'max'      => ':attribute maydoni :max belgidan oshmasligi kerak.',
            'date'     => ':attribute notoʻgʻri sana formatida.',
            'before'   => ':attribute bugungi sanadan oldin boʻlishi shart.',
            'in'       => 'Tanlangan :attribute notoʻgʻri.',
        ];
    }

    protected function passedValidation(): void {
        $this->merge([
            'phone'     => preg_replace('/\s+/', '', $this->phone),
            'phone_two' => $this->phone_two ? preg_replace('/\s+/', '', $this->phone_two) : null,
            'name'      => mb_convert_case($this->name, MB_CASE_TITLE, "UTF-8"),
        ]);
    }
}