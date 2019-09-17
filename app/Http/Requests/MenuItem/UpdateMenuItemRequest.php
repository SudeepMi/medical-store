<?php

namespace App\Http\Requests\MenuItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuItemRequest extends FormRequest
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
            'item_slug'=>'required',
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'category' => 'required',
            'is_discountable'=>'required',
            'discount' =>'required_if:is_discountable,1',
            'image' => 'required|image',
        ];
    }
}
