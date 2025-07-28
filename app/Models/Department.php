<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * Get the functions for the department.
     */
    public function departmentFunctions(): HasMany
    {
        return $this->hasMany(DepartmentFunction::class);
    }

    /**
     * Get the work programs for the department.
     */
    public function workPrograms(): HasMany
    {
        return $this->hasMany(WorkProgram::class);
    }

    /**
     * Get the agendas for the department.
     */
    public function agendas(): HasMany
    {
        return $this->hasMany(Agenda::class);
    }

    /**
     * Get the members for the department.
     */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    /**
     * Get active members for the department.
     */
    public function activeMembers(): HasMany
    {
        return $this->hasMany(Member::class)->active();
    }

    /**
     * Get head members for the department.
     */
    public function headMembers(): HasMany
    {
        return $this->hasMany(Member::class)->head();
    }

    /**
     * Check if department has logo.
     */
    public function hasLogo(): bool
    {
        return ! empty($this->logo);
    }

    /**
     * Check if department has description.
     */
    public function hasDescription(): bool
    {
        return ! empty($this->description);
    }

    /**
     * Check if department has functions.
     */
    public function hasFunctions(): bool
    {
        return $this->departmentFunctions()->count() > 0;
    }

    /**
     * Check if department has work programs.
     */
    public function hasWorkPrograms(): bool
    {
        return $this->workPrograms()->count() > 0;
    }

    /**
     * Check if department has agendas.
     */
    public function hasAgendas(): bool
    {
        return $this->agendas()->count() > 0;
    }

    /**
     * Check if department has active members.
     */
    public function hasActiveMembers(): bool
    {
        return $this->activeMembers()->count() > 0;
    }

    /**
     * Check if department has head members.
     */
    public function hasHeadMembers(): bool
    {
        return $this->headMembers()->count() > 0;
    }

    /**
     * Get staff members for the department (excluding heads).
     */
    public function staffMembers(): HasMany
    {
        return $this->hasMany(Member::class)->staff();
    }

    /**
     * Get active staff members for the department (excluding heads).
     */
    public function activeStaffMembers(): HasMany
    {
        return $this->hasMany(Member::class)->active()->staff();
    }

    /**
     * Check if department has active staff members.
     */
    public function hasActiveStaffMembers(): bool
    {
        return $this->activeStaffMembers()->count() > 0;
    }
}
