<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityInformation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content',
        'image_path',
        'location',
        'start_date',
        'end_date',
        'organizer',
        'registration_fee',
        'registration_deadline',
        'requirements',
        'contact_person',
        'contact_phone',
        'contact_email',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'registration_fee' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
