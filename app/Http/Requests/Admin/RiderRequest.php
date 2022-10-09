<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RiderRequest extends FormRequest
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
            'hub_id'=>'numeric|required',
            'name'=>'required|string|min:4|max:32',
            'present_address' => "required|string|min:4",
            'permanent_address' => "required|string|min:4",
            'salary_type'=>'required',Rule::in(['commission', 'fixed']),
            'commission_type'=>'required_if:salary_type,commission',Rule::in(['percentage', 'fixed']),
            'commission_rate'=>'required_if:salary_type,commission','numeric',

        ];
        $dataForStore =[
            'email'=>'email|nullable|string|min:4|max:32|unique:riders,email',
            'mobile' => "required|digits:11|regex:/(01)[0-9]{9}/|unique:riders,mobile",
            'nid'=>"nullable|numeric|unique:riders,nid",
            'sub_area_id'=>'required|unique:assign_areas,sub_area_id',
        ];
        $dataForUpdate = [
            'email'=>"email|nullable|string|min:4|max:32|unique:riders,email,{$this->id}",
            'mobile' => "required|digits:11|regex:/(01)[0-9]{9}/|unique:riders,mobile,{$this->id}",
            'nid' => "nullable|numeric|unique:riders,nid,{$this->id}",
            'status'=>'required',Rule::in(['active', 'inactive']),
            // 'sub_area_id'=>"required",
        ];
        switch ($this->method()) {
            case 'POST':
                return array_merge($commonData, $dataForStore);
            case 'PATCH':
            case 'PUT':
                return array_merge($commonData, $dataForUpdate);
        }
    }
}
