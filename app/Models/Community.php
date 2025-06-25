<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Community extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'logo',
        'description',
        'category',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get communities by category.
     */
    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Get community type communities.
     */
    public function scopeCommunityType($query)
    {
        return $query->where('category', 'Community');
    }

    /**
     * Get committee type communities.
     */
    public function scopeCommittee($query)
    {
        return $query->where('category', 'Committee');
    }

    /**
     * Check if community is a community type.
     */
    public function isCommunityType(): bool
    {
        return $this->category === 'Community';
    }

    /**
     * Check if community is a committee type.
     */
    public function isCommittee(): bool
    {
        return $this->category === 'Committee';
    }

    /**
     * Get the logo URL.
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }
}
