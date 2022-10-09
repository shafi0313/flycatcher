<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'city_type_id'=>'required|numeric',
                    'area_name' => "string|required|min:4|max:32",
                    'district_id' => "required|numeric",
                    'upazila_id' => "nullable|numeric",
                    'area_code' => "required|string|unique:areas,area_code",
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                    'city_type_id'=>'required|numeric',
                    'area_name' => "string|required|min:4|max:32",
                    'district_id' => "required|numeric",
                    'upazila_id' => "nullable|numeric",
                    'area_code' => "required|string|unique:areas,area_code,{$this->id}",
                ];
                break;
        }
    }
}
