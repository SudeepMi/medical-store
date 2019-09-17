<?php

namespace App\Http\Requests\Wizard;

use Illuminate\Foundation\Http\FormRequest;

class WizardRequest extends FormRequest
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
            "currency" => "required",
            "name_in_bill" => "required",
            "address_in_bill" => "required",
            "vat_no_in_bill" => "required|integer",
            "phone_no_in_bill" => "required",
            "from_year" => "required",
        ];
    }
}
