<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'config_key' => 'required|max:191|min:5',
            'config_value' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'config_key.required' => 'Config key không được để trống',
            'config_key.max' => 'Config key không được quá 191 kí tự',
            'config_key.min' => 'Config key không được dưới 5 kí tự',
            'config_value.required' => 'Config Value không được để trống',
        ];
    }
}
