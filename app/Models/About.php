<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class About extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'definition',
        'position_role',
        'vision',
        'mission',
        'structural',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'mission' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the latest about record.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get the current active about record.
     */
    public static function current(): ?self
    {
        return static::latest()->first();
    }

    /**
     * Get the structural image URL.
     */
    public function getStructuralUrlAttribute(): ?string
    {
        return $this->structural ? Storage::url($this->structural) : null;
    }

    /**
     * Get the mission count.
     */
    public function getMissionCountAttribute(): int
    {
        return is_array($this->mission) ? count($this->mission) : 0;
    }

    /**
     * Get formatted mission list.
     */
    public function getFormattedMissionAttribute(): string
    {
        if (!is_array($this->mission)) {
            return '';
        }

        return implode("\n", array_map(function ($mission, $index) {
            return ($index + 1) . '. ' . $mission;
        }, $this->mission, array_keys($this->mission)));
    }

    /**
     * Get short definition (first 200 characters).
     */
    public function getShortDefinitionAttribute(): string
    {
        return strlen($this->definition) > 200
            ? substr($this->definition, 0, 200) . '...'
            : $this->definition;
    }

    /**
     * Get short vision (first 150 characters).
     */
    public function getShortVisionAttribute(): string
    {
        return strlen($this->vision) > 150
            ? substr($this->vision, 0, 150) . '...'
            : $this->vision;
    }

    /**
     * Check if about has structural image.
     */
    public function hasStructuralImage(): bool
    {
        return !empty($this->structural);
    }

    /**
     * Check if about has missions.
     */
    public function hasMissions(): bool
    {
        return is_array($this->mission) && count($this->mission) > 0;
    }
}
