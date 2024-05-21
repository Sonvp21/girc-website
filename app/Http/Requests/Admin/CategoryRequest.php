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
            'title' => 'required|string|max:255|unique:categories,title,'.$this->category,
            'parent_id' => 'nullable|exists:categories,id',
            'title_en' => 'sometimes|required|string|min:3|max:255',
            'order' => 'nullable',
            'in_menu' => 'required|boolean',
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
