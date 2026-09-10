<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Space extends Model
{
    protected $fillable = [
        'space_id',
        'user_id',
        'name',
        'slug',
        'logo_path',
        'accent_color',
        'header_title',
        'public_link',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'space_id', 'space_id');
    }
}
