<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParcelTypeRequest extends FormRequest
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
                    'name' => "string|required|min:4|max:32|unique:parcel_types,name",
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                    'name' => "string|required|min:4|max:32|unique:parcel_types,name,{$this->id}",
                    'status'=>Rule::in(['active', 'inactive'])
                ];
                break;
        }
    }
}
