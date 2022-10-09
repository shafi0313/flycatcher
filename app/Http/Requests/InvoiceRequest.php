<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'total_collection_amount'=>'required|numeric',
            'total_cod'=>'required|numeric',
            'total_delivery_charge'=>'required|numeric',
            'merchant_id'=>'required|numeric',
            'payment_method'=>'required|string',
            'items' => 'array',
            'note' => 'nullable|string',
        ];
    }
}
