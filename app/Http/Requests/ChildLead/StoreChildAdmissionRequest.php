<?php
namespace App\Http\Requests\ChildLead;
use Illuminate\Foundation\Http\FormRequest;

class StoreChildAdmissionRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    protected function prepareForValidation(): void{
        $this->merge([
            'phone'     => $this->phone ? str_replace([' ', '-', '(', ')'], '', $this->phone) : null,
            'phone_two' => $this->phone_two ? str_replace([' ', '-', '(', ')'], '', $this->phone_two) : null,
            'guvohnoma' => $this->guvohnoma ? strtoupper(str_replace(' ', '', $this->guvohnoma)) : null,
        ]);
    }

    public function rules(): array{
        return [
            'user_id'     => 'required',
            'name'        => 'required|string|max:255',
            'ota_ona'     => 'required|string|max:255',
            'address'     => 'required|string|max:500',
            'phone'       => 'required|string',
            'phone_two'   => 'required|string',
            'guvohnoma'   => 'required|string|max:20|unique:children,guvohnoma',
            'tkun'        => 'required|date',
            'jinsi'       => 'required|in:male,female',
            'description' => 'nullable|string',
            'group_id'    => 'required|exists:groups,id',
        ];
    }
    
    public function messages(): array{
        return [
            'required' => ':attribute '.__('childLead_show.required'),
            'numeric'  => ':attribute '.__('childLead_show.numeric'),
            'digits_between' => ':attribute '.__('childLead_show.digits_between'),
            'exists'   => ':attribute '.__('childLead_show.exists'),
            'unique' => ':attribute '.__('childLead_show.unique'),
        ];
    }

    public function attributes(): array{
        return [
            'phone'     => __('childLead_show.phone'),
            'phone_two' => __('childLead_show.phone_two'),
            'name'      => __('childLead_show.name'),
            'guvohnoma' => __('childLead_show.guvohnoma'),
            'tkun'      => __('childLead_show.tkun'),
        ];
    }

}
