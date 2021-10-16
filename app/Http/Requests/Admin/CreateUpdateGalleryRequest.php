<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUpdateGalleryRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required|',
            'images' => 'required|array',
            'without_album'=>'nullable'
        ];
    }

    public function authorize()
    {
        return auth('admin')->check();
    }
}
