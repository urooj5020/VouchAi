<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function insight(): HasOne
    {
        return $this->hasOne(ReviewInsight::class);
    }
}
