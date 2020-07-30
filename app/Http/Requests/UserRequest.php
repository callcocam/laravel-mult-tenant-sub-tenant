<?php

namespace App\Http\Requests;

use Tenant\Rules\TenantUnique;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            "name"=> [
                'required',
                'string',
                'max:100',
                'min:5'
            ],
            "email"=> [
                'required',
                'email',
                'string',
                'max:150',
                'min:5',
                new TenantUnique('users', $this->id)
            ],
        ];
    }
}
