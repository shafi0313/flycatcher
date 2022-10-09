<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MerchantRequest extends FormRequest
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
            'area_id' => "numeric|required",
            'name' => "string|required",
            'company_name' => "string|required",

        ];
        $dataForStore =[
            'mobile' => "required|digits:11|regex:/(01)[0-9]{9}/|unique:merchants,mobile",
            'email' => "nullable|email|unique:merchants,email",
            'prefix'=>"required|unique:merchants,prefix"
        ];
        $dataForUpdate = [
            'mobile' => "required|digits:11|regex:/(01)[0-9]{9}/|unique:merchants,mobile,{$this->id}",
            'email' => "nullable|email|unique:merchants,email,{$this->id}",
            'prefix' => "required|unique:merchants,prefix,{$this->id}",
            'status'=>'required',Rule::in(['active', 'inactive']),
            'is_active'=>'required',Rule::in( ['enable', 'disable']),
            'isSend'=>'required',Rule::in( ['yes', 'no']),
            'isReturnCharge'=>'required',Rule::in(['apply', 'not_apply']),
        ];
        switch ($this->method()) {
            case 'POST':
                return array_merge($commonData, $dataForStore);
                break;

            case 'PATCH':
            case 'PUT':
                return array_merge($commonData, $dataForUpdate);
                break;
        }
    }
}
