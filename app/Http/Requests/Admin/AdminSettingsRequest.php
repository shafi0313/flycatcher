<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingsRequest extends FormRequest
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
        switch ($this->route()->getName()) {
            case 'admin.settings.profile':
                return [
                    'image' => 'nullable|image',
                    'name' => 'required',
                    'email' => 'required|email',
                    'mobile' => 'required',
                ];
            case 'admin.settings.password.reset':
                return [
                    'old_password' => 'required',
                    //                    'new_password' => "required|min:8|confirmed",
                    'new_password' => [
                        'confirmed',
                        'required',
                        'string',
                        'min:8',             // must be at least 10 characters in length
                    ],
                ];
        }
    }
}
