<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnnouncementRequest extends FormRequest
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
                Rule::unique('announcements')->ignore($this->route('announcement')),
            ],
            'content' => 'required|string',
            'title_en' => 'nullable',
            'content_en' => 'nullable',
            'published_at' => 'nullable|date',
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => trans('admin.field.unique.title'),
            'title.required' => trans('admin.field.required.title'),
            'content.required' => trans('admin.field.required.content'),
        ];
    }
}
