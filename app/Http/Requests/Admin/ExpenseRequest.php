<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExpenseRequest extends FormRequest
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
            'expense_head_id' => "required|numeric",
            'amount' => "required|numeric",
            'note'=>"nullable|string"
        ];
//        switch ($this->method()) {
//            case 'POST':
//                return [
//                    'title' => "string|required|min:4|max:32",
//                    'amount' => "required",
//                ];
//                break;
//
//            case 'PATCH':
//            case 'PUT':
//                return [
//                    'title' => "string|required|min:4|max:32",
//                    'amount' => "required",
//                ];
//                break;
//        }
    }
}
