<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'name' => 'required|min:5|max:255',
                    'email' => 'required|unique:users|min:5|max:255',
                    'password' => 'required|min:6|max:255',
                    'telp' => 'required|min:11',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'name' => 'required|min:5|max:255',
                    'email' => 'required|min:5|max:255|unique:users,email,' . $this->user,
                    'password' => 'nullable|min:6|max:255',
                    'telp' => 'required|min:11',
                ];
            default:
                break;
        }
    }
}
