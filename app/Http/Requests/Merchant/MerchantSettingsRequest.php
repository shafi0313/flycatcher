<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MerchantSettingsRequest extends FormRequest
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
    public function rules(): array
    {
        switch ($this->route()->getName()){
            case 'merchant.settings.personal':
                return [
                    'id'=>'required|numeric',
                    'name' => "string|required|min:4|max:32",
                    'mobile' => "required|digits:11|regex:/(01)[0-9]{9}/|unique:merchants,mobile,{$this->id}",
                    'email' => "nullable|email|unique:merchants,email,{$this->id}",
                ];

                case 'merchant.settings.password.reset':
                return [
                    'old_password'=>'required|string',
                    'password' => "string|required|min:8|confirmed",
                ];
            case 'merchant.settings.company':
                return [
                    'id'=>'required|numeric',
                    'area_id' => "numeric|required",
                    'company_name' => "string|required|min:4|max:32",
                    'address'=>'nullable|string|min:4|max:128',
                    'website_url'=>"nullable|url|unique:merchants,website_url,{$this->id}",
                    'facebook_page'=>"nullable|url|regex:/http(?:s):\/\/(?:www\.)facebook\.com\/.+/i|unique:merchants,facebook_page,{$this->id}",
                ];
            case 'merchant.settings.pickup.method':
                return [
                    'id'=>'nullable|numeric',
                    'hub_id' => "numeric|required",
                    'pickup_type' => Rule::in(['daily', 'as_per_request']),
                ];
            case 'merchant.settings.payment.method':
                return [
                    'payment_method_id' => "numeric|required",
                    'withdraw_type' => Rule::in(['daily', 'as_per_request']),
                ];
            case 'merchant.settings.mobile.banking':
                return [
                    'bkash' => "nullable|numeric|digits:11|regex:/(01)[0-9]{9}/|unique:mobile_bankings,bkash",
                    'rocket' => "nullable|numeric|digits:12|regex:/(01)[0-9]{9}/|unique:mobile_bankings,rocket",
                    'nogod' => "nullable|numeric|digits:11|regex:/(01)[0-9]{9}/|unique:mobile_bankings,nogod",
                ];
            case 'merchant.settings.bank.account':
                return [
                    'id'=>'nullable|numeric',
                    'bank_id' => "numeric|required",
                    'branch_name' => "required|string|min:4",
                    'routing_number' => 'nullable|numeric',
                    'account_name' => 'required|string',
                    'account_number' => 'required|numeric',
                ];
        }
    }
}
