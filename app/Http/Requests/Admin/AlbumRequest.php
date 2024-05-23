<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlbumRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments')->ignore($this->department->id ?? null),
            ],
            'type' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => trans('admin.field.unique.name'),
            'name.required' => trans('admin.field.required.name'),
            'type.required' => trans('admin.field.required.type'),
        ];
    }
}
