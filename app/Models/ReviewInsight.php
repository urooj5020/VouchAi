<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewInsight extends Model
{
    protected $fillable = [
        'review_id',
        'sentiment',
        'headline_quote',
        'linkedin_post',
        'x_post',
        'suggested_reply',
    ];
}
