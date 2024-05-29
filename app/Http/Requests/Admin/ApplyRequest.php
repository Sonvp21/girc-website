<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ApplyMajorEnum;

class ApplyRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'nullable',
            'school' => 'nullable',
            'major' => 'required|in:' . implode(',', array_column(ApplyMajorEnum::cases(), 'value')),
            'question' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('admin.apply.required.name'),
            'phone.required' => trans('admin.apply.required.phone'),
            'major.required' => trans('admin.apply.required.major'),
            'question.required' => trans('admin.apply.required.question'),
        ];
    }
}
