<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (int) $this->user_id === auth()->id();
    }

    public function rules(): array
    {
        return [
            'album_id' => 'required|exists:albums,id',
            'name' => 'required|string|max:255',
            'video_id' => 'required|string',
            'source' => 'required|max:2048',
            'image' => 'sometimes|required|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'album_id.required' => trans('admin.field.required.album_id'),
            'name.required' => trans('admin.field.required.name'),
            'video_id.required' => trans('admin.field.required.video_id'),
            'source.required' => trans('admin.field.required.source'),
            'image.required' => trans('admin.field.required.image'),
        ];
    }
}
