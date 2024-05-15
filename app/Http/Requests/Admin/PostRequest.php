<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->id === 1; //sample only, it should be auth()->user()->role === 'admin'
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'title' => 'required|unique:posts,title',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => trans('admin.field.required'),
            'title.unique' => trans('admin.field.unique'),
            'title.required' => trans('admin.field.required'),
            'content.required' => trans('admin.field.required'),
        ];
    }
}
