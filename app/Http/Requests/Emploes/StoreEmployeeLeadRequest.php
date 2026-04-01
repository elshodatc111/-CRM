<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeLeadRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string',
            'phone_two' => 'nullable|string',
            'address' => 'required|string',
            'birth_date' => 'required|date',
            'education' => 'required|string',
            'institution_name' => 'required|string',
            'last_workplace' => 'required|string',
            'manba' => 'required|string',
            'expected_salary' => 'required',
            'maqsadi' => 'required|string',
            'role' => 'required|string',
            'about' => 'required|string',
        ];
    }

    public function messages(): array{
        return [
            'required' => ':attribute '.__('emploes_lead_page.maydonni_toldirish_majburiy').'.',
            'string'   => ':attribute '.__('emploes_lead_page.matn_bolishi_kerak').'.',
            'max'      => ':attribute '.__('emploes_lead_page.max_belgidan_kop_bolmasligi_kerak').'.',
            'date'     => ':attribute '.__('emploes_lead_page.sana_formati_notogri').'.',
        ];
    }

    public function attributes(): array{
        return [
            'name'             => __('emploes_lead_page.fio'),
            'phone'            => __('emploes_lead_page.phone'),
            'phone_two'        => __('emploes_lead_page.phone_extra'),
            'address'          => __('emploes_lead_page.address'),
            'birth_date'       => __('emploes_lead_page.birth_date'),
            'education'        => __('emploes_lead_page.education'),
            'institution_name' => __('emploes_lead_page.institution'),
            'last_workplace'   => __('emploes_lead_page.last_work'),
            'manba'            => __('emploes_lead_page.source'),
            'expected_salary'  => __('emploes_lead_page.salary'),
            'maqsadi'          => __('emploes_lead_page.goal'),
            'role'             => __('emploes_lead_page.position'),
            'about'            => __('emploes_lead_page.about'),
        ];
    }

    protected function passedValidation(): void{
        $this->merge([
            'phone' => $this->formatPhone($this->phone),
            'phone_two' => $this->phone_two ? $this->formatPhone($this->phone_two) : null,
            'expected_salary' => (int) str_replace([' ', ','], '', $this->expected_salary),
        ]);
    }

    private function formatPhone($phone): string{
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        return '+998' . $cleanPhone;
    }
}