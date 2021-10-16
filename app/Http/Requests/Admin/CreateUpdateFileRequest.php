<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUpdateFileRequest extends FormRequest
{

    public function rules()
    {
        return [
            'title' => 'required',
            'file' => (request('attachment')?"nullable":"required").'|file|mimes:jpeg,png,jpg,zip,pdf,doc,docx|max:2048',
            'album_id' => 'required|exists:albums,id',
        ];
    }

    public function authorize()
    {
        return auth('admin')->check();
    }
}
