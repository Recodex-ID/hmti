<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Partnership extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'title',
        'description',
        'content',
        'contact_info',
        'banner',
        'document',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'content' => 'array',
        'contact_info' => 'array',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Partnership types.
     */
    public static array $types = [
        'benchmark' => 'Benchmark Partnership',
        'media_partner' => 'Media Partner',
        'mc_moderator' => 'MC & Moderator',
    ];

    /**
     * Get partnerships by type.
     */
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Get active partnerships.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the banner image URL.
     */
    public function getBannerUrlAttribute(): ?string
    {
        return $this->banner ? Storage::url($this->banner) : null;
    }

    /**
     * Get the document URL.
     */
    public function getDocumentUrlAttribute(): ?string
    {
        return $this->document ? Storage::url($this->document) : null;
    }

    /**
     * Check if partnership has banner.
     */
    public function hasBanner(): bool
    {
        return ! empty($this->banner);
    }

    /**
     * Check if partnership has document.
     */
    public function hasDocument(): bool
    {
        return ! empty($this->document);
    }

    /**
     * Check if partnership has content.
     */
    public function hasContent(): bool
    {
        return is_array($this->content) && count($this->content) > 0;
    }

    /**
     * Check if partnership has contact info.
     */
    public function hasContactInfo(): bool
    {
        return is_array($this->contact_info) && count($this->contact_info) > 0;
    }

    /**
     * Get formatted type name.
     */
    public function getFormattedTypeAttribute(): string
    {
        return static::$types[$this->type] ?? $this->type;
    }

    /**
     * Get partnership by type (single record).
     */
    public static function getByType(string $type): ?self
    {
        return static::byType($type)->active()->first();
    }
}
