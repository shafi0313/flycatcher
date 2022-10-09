<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParcelStatusRequest extends FormRequest
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
            'status' => Rule::in(['delivered', 'partial', 'hold', 'cancelled', 'mobileBanking','exchange']),
            'parcel_id'=> ['required', 'unique:collections,parcel_id'],
            //partial delivery
            'partial_amount' => ['required_if:status,===,partial'],
            'return_product'=>['required_if:status,==,partial|numeric'],
            'note' => 'nullable',



            //'return_product'=>['required_with:foo,bar,...','numeric']

            //for mobile banking request
            'mobile_banking_id' => ['required_if:status,===,mobileBanking'],
            'merchant_mobile_banking_id' => 'nullable|numeric',
            'customer_mobile_number' => ['required_if:status,===,mobileBanking'],
            'mobile_partial_amount' => ['required_if:status,===,mobileBanking'],
            'mobile_return_product' => ['required_if:status,===,mobileBanking'],
            'mobile_note' => 'string|nullable',
            'mobile_banking_amount' => ['required_if:status,===,mobileBanking'],

            //Hold Reason
            'hold_reason' => ['numeric', 'required_if:status,==,hold'],
            'hold_note' => 'nullable',

            //cancel Reason
            'cancel_reason' => ['numeric', 'required_if:status,==,cancelled'],
            'cancel_collection' => ['numeric', 'required_if:status,==,cancelled'],
            'cancel_note' => 'nullable',
        ];
    }
}
