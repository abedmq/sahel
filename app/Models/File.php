<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends BaseModel
{
    use HasFactory;

    protected $fillable = ['url', 'original_name', 'title', 'extension', 'size', 'type', 'file_type', 'album_id', 'user_id', 'sort', 'admin_id', 'status'];

    function album()
    {
        return $this->belongsTo(Album::class);
    }

    function scopeType($q, $type = 'attachment')
    {
        $q->where('file_type', $type);
    }

    function getImage($size = 'low')
    {
        return url(get_images_folder($size) . $this->url);
    }

    function getFile()
    {
        return 'storage/files/' . $this->url;
    }
}
