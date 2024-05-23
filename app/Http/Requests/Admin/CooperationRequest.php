<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CooperationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'link_website' => 'required|string',
            'description' => 'required|string',
            'image' => 'sometimes|required|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('admin.field.required.name'),
            'link_website.required' => trans('admin.field.required.link'),
            'description.required' => trans('admin.field.required.description'),
            'image.required' => trans('admin.field.required.image'),
        ];
    }
}
