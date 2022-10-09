<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HubRequest extends FormRequest
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
                    'name'=>'required|string',
                    'hub_code'=>'required|string|min:3|max:4|unique:hubs,hub_code',
                ];

            case 'PATCH':
            case 'PUT':
                return [
                    'area_id'=>'required|numeric',
                    'name'=>'required|string',
                    'hub_code'=>"required|string|min:3|max:4|unique:hubs,hub_code,{$this->id}",
                    'status'=>Rule::in(['active', 'inactive']),
                ];

        }
    }
}
