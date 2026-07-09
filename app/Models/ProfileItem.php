<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileItem extends Model
{
    protected $fillable = [
        'profile_section_id',
        'item_group',
        'title',
        'content',
        'sort_order',
        'is_active',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(ProfileSection::class, 'profile_section_id');
    }
}