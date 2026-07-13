<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $fillable = [
        'section_key',
        'badge',
        'title',
        'description',
        'button_text',
        'button_url',
        'image',
        'is_active',
    ];
}