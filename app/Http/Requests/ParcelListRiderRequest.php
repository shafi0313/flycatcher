<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParcelListRiderRequest extends FormRequest
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
            'rider_id'=>'required|numeric',
            'status'=>'nullable', Rule::in(['delivered', 'partial', 'hold', 'transit', 'cancelled']),
            'daterange'=>'required'
        ];
    }
}
