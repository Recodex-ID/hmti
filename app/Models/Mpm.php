<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Mpm extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'content',
        'banner_image',
        'attachment_file',
        'is_active',
    ];

    protected $casts = [
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    public function getBannerImageUrlAttribute()
    {
        return $this->banner_image ? Storage::url($this->banner_image) : null;
    }

    public function getAttachmentFileUrlAttribute()
    {
        return $this->attachment_file ? Storage::url($this->attachment_file) : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public static function getByType($type)
    {
        return static::active()->byType($type)->first();
    }

    public static function getTypes()
    {
        return [
            'komisi-a' => 'Komisi A',
            'komisi-b' => 'Komisi B', 
            'komisi-c' => 'Komisi C',
            'burt' => 'BURT',
        ];
    }
}
