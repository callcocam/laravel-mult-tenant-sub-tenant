<?php

namespace Tenant\Http\Requests;

use Tenant\Rules\TenantUnique;
use Illuminate\Foundation\Http\FormRequest;

class TenantRequest extends FormRequest
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
                'min:5',
                new TenantUnique('tenants', $this->id)],
        ];
    }
}
