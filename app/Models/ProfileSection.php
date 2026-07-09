<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProfileSection extends Model
{
    protected $fillable = [
        'slug',
        'title',
        'subtitle',
        'description',
        'sort_order',
        'is_active',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ProfileItem::class)->orderBy('sort_order');
    }
}