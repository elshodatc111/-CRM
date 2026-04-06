<?php

namespace App\Http\Requests\Emploes;

use App\Models\Balans;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreUserPaymentRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    protected function prepareForValidation(){
        if ($this->salary) {
            $this->merge([
                'salary' => str_replace(' ', '', $this->salary),
            ]);
        }
    }
    
    public function rules(): array{
        return [
            'user_id'     => 'required|exists:users,id',
            'salary'      => 'required|numeric|min:0.01',
            'type'        => 'required|in:cash,card,bank,sub',
            'description' => 'required|string|max:1000',
        ];
    }

    public function withValidator(Validator $validator){
        $validator->after(function ($validator) {
            if ($validator->errors()->count() > 0) {
                return;
            }
            $type = $this->type;
            $amount = (float) $this->salary;
            $balans = Balans::getInstance();
            if ($balans->$type < $amount) {
                $validator->errors()->add(
                    'salary', 
                    __('emploes_show.balansda_mablag_yetarli_emas')
                );
            }
        });
    }

    public function messages(): array{
        return [
            'salary.required' => __('emploes_show.salary_required'),
            'salary.numeric'  => __('emploes_show.salary_numeric'),
            'salary.min'      => __('emploes_show.salary_min'),
            'type.required'   => __('emploes_show.type_required'),
        ];
    }
}
