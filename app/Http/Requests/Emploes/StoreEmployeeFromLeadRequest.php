<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeFromLeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_lead_id' => 'required|exists:user_leads,id',
            'name'         => 'required|string|max:255',
            'phone'        => 'required|string',
            'phone_two'    => 'nullable|string',
            'address'      => 'required|string',
            'salary'       => 'required',
            'tkun'         => 'required|date',
            'pasport'      => 'required|string|max:20',
            'role'         => 'required|in:tarbiyachi,yordamchi,teacher,oshpaz,farrosh,xodim',
            'about'        => 'nullable|string',
        ];
    }

    public function messages(): array{
        return [
            'required' => ':attribute '.__(('emploes_lead_page_show.maydonni_toldirish_majburiy')).'.',
            'exists'   => __('emploes_lead_page_show.tanlangan') . ':attribute ' . __('emploes_lead_page_show.tizimda_mavjud_emas'),
            'in'       => __('emploes_lead_page_show.tanlangan') .' :attribute '.__('emploes_lead_page_show.notogri').'.',
            'date'     => ':attribute ' . __('emploes_lead_page_show.sana_formati_xato') . '.',
            'string'   => ':attribute ' . __('emploes_lead_page_show.matn_korinishida_bolishi_kerak') . '.',
            'max'      => ':attribute '.__('emploes_lead_page_show.juda_uzun').'.',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_lead_id' => __('emploes_lead_page_show.user_lead_id'),
            'name'         => __('emploes_lead_page_show.name'),
            'phone'        => __('emploes_lead_page_show.phone'),
            'phone_two'    => __('emploes_lead_page_show.phone_two'),
            'address'      => __('emploes_lead_page_show.address'),
            'salary'       => __('emploes_lead_page_show.salary'),
            'tkun'         => __('emploes_lead_page_show.tkun'),
            'pasport'      => __('emploes_lead_page_show.pasport'),
            'role'         => __('emploes_lead_page_show.role'),
            'about'        => __('emploes_lead_page_show.about'),
        ];
    }

    protected function passedValidation(): void{
        $this->merge([
            'pasport'   => str_replace(' ', '', strtoupper($this->pasport)),
            'phone'     => preg_replace('/\s+/', '', $this->phone),
            'phone_two' => $this->phone_two ? preg_replace('/\s+/', '', $this->phone_two) : null,
            'salary'    => (int) str_replace([' ', ','], '', $this->salary),
        ]);
    }
}