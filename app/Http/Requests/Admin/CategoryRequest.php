<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                    'name' => 'required|min:2|max:255',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'name' => 'required|min:2|max:255',
                ];
            default:
                break;
        }
    }
}
