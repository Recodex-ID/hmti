<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Department extends Model
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
        'division',
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
     * Get departments by division.
     */
    public function scopeByDivision($query, string $division)
    {
        return $query->where('division', $division);
    }

    /**
     * Get internal departments.
     */
    public function scopeInternal($query)
    {
        return $query->where('division', 'Internal');
    }

    /**
     * Get PSTI departments.
     */
    public function scopePsti($query)
    {
        return $query->where('division', 'PSTI');
    }

    /**
     * Get external departments.
     */
    public function scopeEksternal($query)
    {
        return $query->where('division', 'Eksternal');
    }

    /**
     * Check if department is internal.
     */
    public function isInternal(): bool
    {
        return $this->division === 'Internal';
    }

    /**
     * Check if department is PSTI.
     */
    public function isPsti(): bool
    {
        return $this->division === 'PSTI';
    }

    /**
     * Check if department is external.
     */
    public function isEksternal(): bool
    {
        return $this->division === 'Eksternal';
    }

    /**
     * Get the logo URL.
     */
    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? Storage::url($this->logo) : null;
    }
}
