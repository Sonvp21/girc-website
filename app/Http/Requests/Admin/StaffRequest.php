<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'sometimes|required|image|max:2048',
            'category' => 'required|string:enum:App\Enums\StaffCategoryEnum',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('admin.field.required.name'),
            'content.required' => trans('admin.field.required.content'),
            'image.required' => trans('admin.field.required.image'),
            'departments.required' => trans('admin.field.required.departments'),
        ];
    }
}
