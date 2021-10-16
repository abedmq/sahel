<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterFile extends BaseModel
{
    protected $fillable = ['letter_id', 'user_id', 'variable', 'sort', 'admin_id','image', 'status', 'image_preview', 'pdf_preview', 'preview_date'];

    protected $casts = [
        'variable' => 'array'
    ];

    protected $dates = ['preview_date'];

    function letter()
    {
        return $this->belongsTo(Letter::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }


    function getImageInfo()
    {
        $image = $this->letter->images[$this->image] ?? $this->letter->images[0];
        $data = getimagesize(storage_path('app/original/' . $image));
        $data['image'] = $image;
        $data['retion'] = $data[0] / $data[1] ?: 1;
        return $data;
    }
}
