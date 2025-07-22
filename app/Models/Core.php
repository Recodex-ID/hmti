<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Core extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'photo',
        'position',
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
     * Position hierarchy for ordering.
     *
     * @var array<string, int>
     */
    public static array $positionHierarchy = [
        'Ketua Himpunan' => 1,
        'Wakil Ketua Himpunan' => 2,
        'Sekretaris Jenderal' => 3,
        'Sekretaris' => 4,
        'Bendahara' => 5,
    ];

    /**
     * Get cores ordered by position hierarchy.
     */
    public function scopeOrderedByPosition($query)
    {
        return $query->orderByRaw("
            CASE position
                WHEN 'Ketua Himpunan' THEN 1
                WHEN 'Wakil Ketua Himpunan' THEN 2
                WHEN 'Sekretaris Jenderal' THEN 3
                WHEN 'Sekretaris' THEN 4
                WHEN 'Bendahara' THEN 5
                ELSE 6
            END
        ");
    }

    /**
     * Get cores by specific position.
     */
    public function scopeByPosition($query, string $position)
    {
        return $query->where('position', $position);
    }

    /**
     * Get the chairman (Ketua Himpunan).
     */
    public function scopeChairman($query)
    {
        return $query->where('position', 'Ketua Himpunan');
    }

    /**
     * Get the vice chairman (Wakil Ketua Himpunan).
     */
    public function scopeViceChairman($query)
    {
        return $query->where('position', 'Wakil Ketua Himpunan');
    }

    /**
     * Get secretaries (both types).
     */
    public function scopeSecretaries($query)
    {
        return $query->whereIn('position', ['Sekretaris Jenderal', 'Sekretaris']);
    }

    /**
     * Get the treasurer (Bendahara).
     */
    public function scopeTreasurer($query)
    {
        return $query->where('position', 'Bendahara');
    }

    /**
     * Check if core is chairman.
     */
    public function isChairman(): bool
    {
        return $this->position === 'Ketua Himpunan';
    }

    /**
     * Check if core is vice chairman.
     */
    public function isViceChairman(): bool
    {
        return $this->position === 'Wakil Ketua Himpunan';
    }

    /**
     * Check if core is secretary (any type).
     */
    public function isSecretary(): bool
    {
        return in_array($this->position, ['Sekretaris Jenderal', 'Sekretaris']);
    }

    /**
     * Check if core is treasurer.
     */
    public function isTreasurer(): bool
    {
        return $this->position === 'Bendahara';
    }

    /**
     * Get the photo URL.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    /**
     * Get the position hierarchy number.
     */
    public function getPositionHierarchyAttribute(): int
    {
        return static::$positionHierarchy[$this->position] ?? 999;
    }

    /**
     * Get formatted position name.
     */
    public function getFormattedPositionAttribute(): string
    {
        return ucwords(strtolower($this->position));
    }

    /**
     * Get initials from name.
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';

        foreach ($words as $word) {
            if (! empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }

        return $initials;
    }

    /**
     * Check if core has photo.
     */
    public function hasPhoto(): bool
    {
        return ! empty($this->photo);
    }
}
