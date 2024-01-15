<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
                    'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'title' => 'required|min:3|max:255',
                    'date_course' => 'required|min:24|max:24',
                    'trailer' => 'nullable',
                    'category_id' => 'required|exists:categories,id',
                    'design_id' => 'required',
                    'price' => 'required',
                    'duration' => 'required',
                    'team_id' => 'required|exists:teams,id'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    'title' => 'required|min:3|max:255',
                    'date_course' => 'required|min:24|max:24',
                    'trailer' => 'nullable',
                    'category_id' => 'required|exists:categories,id',
                    'design_id' => 'required',
                    'price' => 'required',
                    'duration' => 'required',
                    'team_id' => 'required|exists:teams,id'
                ];
            default:
                break;
        }
    }
}
