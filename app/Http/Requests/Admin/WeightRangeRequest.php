<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WeightRangeRequest extends FormRequest
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
                    'min_weight' => "required|numeric",
                    'max_weight' => "required|numeric|gt:min_weight",
                ];
                break;

            case 'PATCH':
            case 'PUT':
                return [
                    'min_weight' => "required|numeric",
                    'max_weight' => "required|numeric|gt:min_weight",
                    'status'=>'required', Rule::in(['active', 'inactive']),
                ];
                break;
        }
    }
}
