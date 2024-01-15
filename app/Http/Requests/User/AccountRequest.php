<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;


class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'  => 'required|min:5|max:255',
            'email' => 'required|min:5|max:255|unique:users,email,' . auth('web')->id(),
            'telp' => 'required|min:11',
        ];
    }
}
