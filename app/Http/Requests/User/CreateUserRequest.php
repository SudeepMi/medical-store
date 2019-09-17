<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;


class CreateUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'phone' => 'required|min:10',
            'email'=>'required|email|unique:users',
            'address' => 'required|max:255',
            'pin' => 'required|min:5|integer',
            'role' => 'required|max:255',
            'password' => 'required|min:8',
            'discount'=> 'sometimes|min:0|max:100',
        ];
    }
}
