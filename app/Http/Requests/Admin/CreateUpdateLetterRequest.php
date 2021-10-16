<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUpdateLetterRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required|',
            'style' => 'nullable|',
            'images' => 'required|array|min:0',
            'variable' => 'nullable|array|min:0',
        ];
    }

    public function authorize()
    {
        return auth('admin')->check();
    }
}
