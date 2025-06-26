<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CircularLetter extends Model
{
    protected $fillable = [
        'title',
        'description',
        'content',
        'file_path',
        'number',
        'letter_date',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'letter_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
