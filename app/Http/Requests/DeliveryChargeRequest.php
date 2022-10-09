<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeliveryChargeRequest extends FormRequest
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
        $commonData = [
            'city_type_id'=>'required|numeric',
            'weight_range_id'=>'required|numeric',
            'delivery_charge'=>'required|numeric|min:1',
            'cod'=>'required|numeric|min:0',
        ];
        switch ($this->method()) {
            case 'POST':
                return $commonData;


            case 'PATCH':
            case 'PUT':
                return array_merge($commonData, [
                   'status'=>Rule::in(['active', 'inactive']),
                ]);
                break;
        }
    }
}
