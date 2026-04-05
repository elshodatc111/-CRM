<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmploesDavomadrRequest extends FormRequest{

    public function authorize(): bool{
        return true; 
    }

    public function rules(): array{
        return [
            'attendance' => 'required|array|min:1',
            'attendance.*.user_id' => 'required|exists:users,id',
            'attendance.*.status'  => 'required|in:keldi,keldi_formasiz,kechikdi_formasiz,kechikdi_sababli,kechikdi_sababsiz,kelmadi,kelmadi_sababli',
            'attendance.*.description' => 'nullable|string|max:500',
        ];
    }
    
    public function messages(): array{
        return [
            'attendance.required' => __('home.attendance_required'),
            'attendance.*.user_id.exists' => __('home.attendance_user_id_exists'),
            'attendance.*.status.required' => __('home.attendance_status_required'),
            'attendance.*.status.in' => __('home.attendance_status_in'),
        ];
    }
}
