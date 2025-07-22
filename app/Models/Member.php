<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department_id',
        'name',
        'position',
        'photo',
        'start_year',
        'end_year',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_year' => 'integer',
        'end_year' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Position options.
     */
    public static array $positionOptions = [
        'head' => 'Head',
        'staff' => 'Staff',
    ];

    /**
     * Get the department that owns the member.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get members by position.
     */
    public function scopeByPosition($query, string $position)
    {
        return $query->where('position', $position);
    }

    /**
     * Get head members.
     */
    public function scopeHead($query)
    {
        return $query->where('position', 'head');
    }

    /**
     * Get staff members.
     */
    public function scopeStaff($query)
    {
        return $query->where('position', 'staff');
    }

    /**
     * Get active members (no end year or end year in future).
     */
    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('end_year')
                ->orWhere('end_year', '>', now()->year);
        });
    }

    /**
     * Get alumni members (end year in past).
     */
    public function scopeAlumni($query)
    {
        return $query->where('end_year', '<=', now()->year);
    }

    /**
     * Get the photo URL.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        return $this->photo ? Storage::url($this->photo) : null;
    }

    /**
     * Get formatted position.
     */
    public function getFormattedPositionAttribute(): string
    {
        return static::$positionOptions[$this->position] ?? $this->position;
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
     * Get period range.
     */
    public function getPeriodRangeAttribute(): string
    {
        if ($this->end_year) {
            return $this->start_year.' - '.$this->end_year;
        }

        return $this->start_year.' - Present';
    }

    /**
     * Check if member is active.
     */
    public function isActive(): bool
    {
        return ! $this->end_year || $this->end_year > now()->year;
    }

    /**
     * Check if member is head.
     */
    public function isHead(): bool
    {
        return $this->position === 'head';
    }

    /**
     * Check if member has photo.
     */
    public function hasPhoto(): bool
    {
        return ! empty($this->photo);
    }
}
