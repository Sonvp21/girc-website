<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->id === 1; //sample only, it should be auth()->user()->role === 'admin'
    }

    public function rules(): array
    {
        return [
            'title' => 'required|unique:categories,title',
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => trans('admin.field.unique'),
            'title.required' => trans('admin.field.required'),
        ];
    }
}
