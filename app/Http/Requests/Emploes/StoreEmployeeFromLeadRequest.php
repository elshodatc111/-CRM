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

    public function messages(): array
    {
        return [
            'required' => ':attribute maydonini toʻldirish majburiy.',
            'exists'   => 'Tanlangan :attribute tizimda mavjud emas.',
            'in'       => 'Tanlangan :attribute notoʻgʻri.',
            'date'     => ':attribute sana formati xato.',
            'string'   => ':attribute matn koʻrinishida boʻlishi kerak.',
            'max'      => ':attribute juda uzun.',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_lead_id' => 'Lead ID',
            'name'         => 'FIO',
            'phone'        => 'Telefon raqam',
            'phone_two'    => 'Qoʻshimcha telefon raqami',
            'address'      => 'Yashash manzili',
            'salary'       => 'Ish haqi',
            'tkun'         => 'Tugʻilgan sana',
            'pasport'      => 'Pasport maʻlumotlari',
            'role'         => 'Lavozim',
            'about'        => 'Xodim haqida',
        ];
    }

    protected function passedValidation(): void
    {
        $this->merge([
            // Pasportdan probellarni olib tashlash va katta harfga o'tkazish
            'pasport'   => str_replace(' ', '', strtoupper($this->pasport)),
            
            // Telefon raqamlaridan barcha probellarni butkul tozalash
            'phone'     => preg_replace('/\s+/', '', $this->phone),
            'phone_two' => $this->phone_two ? preg_replace('/\s+/', '', $this->phone_two) : null,
            
            // Ish haqidan probel va vergullarni tozalab, songa aylantirish
            'salary'    => (int) str_replace([' ', ','], '', $this->salary),
        ]);
    }
}