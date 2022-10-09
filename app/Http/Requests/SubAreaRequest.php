<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubAreaRequest extends FormRequest
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
                    'area_id'=>'required|numeric',
                    'name' => "string|required",
                    'code' => "required|string|unique:sub_areas,code",
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                    'id'=>'required|numeric',
                    'area_id'=>'required|numeric',
                    'name' => "string|required",
                    'code' => "required|string|unique:sub_areas,code,{$this->id}",
                    'status'=>"required|",Rule::in(['active', 'inactive']),
                ];
                break;
        }
    }
}
