<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ScienceInformationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'title_en' => 'nullable|string|max:255',
            'keep_on_top' => 'required|boolean',
            'content' => 'required|string',
            'published_at' => 'required|date',
            'image' => 'sometimes|required|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('admin.science_infor.required.title'),
            'title.max' => trans('admin.science_infor.max.title', ['max' => 255]),
            'title.unique' => trans('admin.science_infor.unique.title'),
            'title_en.max' => trans('admin.science_infor.max.title_en', ['max' => 255]),
            'keep_on_top.boolean' => trans('admin.science_infor.boolean.keep_on_top'),
            'content.required' => trans('admin.science_infor.required.content'),
            'published_at.required' => trans('admin.science_infor.required.published_at'),
            'published_at.date' => trans('admin.science_infor.date.published_at'),
            'image.required' => trans('admin.field.required.image'),
        ];
    }
}
