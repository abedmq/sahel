<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUpdateAlbumRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required|',
        ];
    }

    public function authorize()
    {
        return auth('admin')->check();
    }
}
