<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = [
        'name',
        'email',
        'designation',
        'content',
        'ai_sentiment',
        'status',
        'space_id',
    ];

    public function space(): BelongsTo
    {
        return $this->belongsTo(Space::class, 'space_id', 'space_id');
    }
}
