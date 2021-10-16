<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends BaseModel
{
    use HasFactory;

    protected $fillable = ['title', 'sort', 'admin_id', 'status', 'type', 'is_system'];
    protected $appends = ['type_text'];

    function files()
    {
        return $this->hasMany(File::class);
    }

    function scopeType($q, $type = 'attachment')
    {
        $q->where('type', $type);
    }

    function deleteItem()
    {
        $this->files()->delete();
        $this->delete();
        return true;
    }

    function getTypeTextAttribute()
    {
        switch ($this->type) {
            case "ready_attachment":
                return 'مرفقات جاهزة';
            case "gallery":
                return 'معرض الصور';
            case "galleries":
                return 'معرض الصور';
        }
    }

}
