<?php

namespace App\Models;


use Aws\signer\Exception\signerException;
use Illuminate\Support\Str;

class Letter extends BaseModel
{

    protected $fillable = ['title', 'images', 'type', 'variable', 'sort', 'admin_id', 'status', 'style'];

    protected $casts = [
        'images' => 'array',
        'variable' => 'array',
    ];

    const TYPES = [
        'letter',
        'thanks',
        'invitations'
    ];

    function scopeType($q, $type = 'letter')
    {
        $q->where('type', $type);
    }

    function getTitle($isSingle = false)
    {
        return self::title($this->type, $isSingle);
    }

    static function title($type, $isSingle = false)
    {
        switch ($type) {
            case 'letter':

                return $isSingle ? "الخطاب" : 'الخطابات';
            case 'thanks':
                return $isSingle ? "قالب الشكر" : "قوالب الشكر";
            case 'invitations':
                return $isSingle ? "الدعوى" : "الدعوات الجاهزة";
        }
    }

    function files()
    {
        return $this->hasMany(LetterFile::class, 'letter_id');
    }

    function getStyle($varKey, $attributeName = null)
    {
        $style = $this->variable[$varKey]['style'] ?? '';

        if ($style) {
            $styles = explode(';', $style);

            $attributes = [];
            foreach ($styles as $style) {
                $attribute = explode(':', $style);
                if (sizeof($attribute) >= 2)
                    $attributes[$attribute[0]] = $attribute[1];
            };

            if ($attributeName)
                return Str::replace('px', '',$attributes[$attributeName] ?? ($attributeName == 'color' ? "#000" : ($attributeName == 'font-size' ? '25' :'')));

            return $attributes;
        }
        return $attributeName == 'color' ? "#000" : ($attributeName == 'font-size' ? '25' : '');
    }

}
