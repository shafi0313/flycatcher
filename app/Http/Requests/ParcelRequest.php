<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ParcelRequest extends FormRequest
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
        $data =[
            'customer_name' => 'required|string',
            'city_type_id' => 'required|numeric',
            'parcel_type_id' => 'required|numeric',
            'weight_range_id' => 'required|numeric',
            'area_id' => 'required|numeric',
            'customer_mobile' => "required|digits:11|regex:/(01)[0-9]{9}/",
            'customer_another_mobile' => "nullable|digits:11|regex:/(01)[0-9]{9}/",
            'customer_address' => "required|string",
            'collection_amount' => "required|numeric",
            'payment_status' => Rule::in(['paid', 'unpaid']),
            'status' => Rule::in(['pending', 'delivered', 'hold', 'transit', 'return', 'cancelled']),
            'note' => "nullable|string",
            'delivery_charge'=>"required|numeric",
            "cod"=>"required|numeric",
            'invoice_id'=>"required|string",
            'assigning_by'=>'required|numeric',
            'sub_area_id'=>'nullable|numeric',
            'added_date'=>'nullable'
        ];
        switch ($this->route()->getName()){
            case 'admin.parcel.store':
            case 'admin.parcel.update':
                return array_merge($data, ['merchant_id' => 'required|numeric']);
            case 'merchant.parcel.store':
            case 'merchant.parcel.request.update':
                return $data;
        }
//        return [
//
//        ];
    }
}
