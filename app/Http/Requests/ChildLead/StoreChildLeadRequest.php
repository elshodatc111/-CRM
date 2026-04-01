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
            'name'      => __('childLead.fio'),
            'phone'     => __('childLead.asosiy_phone'),
            'phone_two' => __('childLead.qoshimcha_phone'),
            'ota_ona'   => __('childLead.ota_onasi'),
            'address'   => __('childLead.address'),
            'tkun'      => __('childLead.tkun'),
            'jinsi'     => __('childLead.jinsi'),
        ];
    }

    public function messages(): array {
        return [
            'required' => ':attribute'.__('childLead.required'),
            'string'   => ':attribute'.__('childLead.string'),
            'max'      => ':attribute'.__('childLead.max'),
            'date'     => ':attribute'.__('childLead.date'),
            'before'   => ':attribute'.__('childLead.before'),
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