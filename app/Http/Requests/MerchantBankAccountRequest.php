<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MerchantBankAccountRequest extends FormRequest
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
            'id'=>'nullable|numeric',
            'bank_id' => "numeric|required",
            'branch_name' => "required|string",
            'routing_number' => 'required|numeric',
            'account_name' => 'required|string',
            'account_number' => 'required|numeric',
            'status'=>'sometimes',Rule::in(['active', 'inactive'])
        ];
    }
}
