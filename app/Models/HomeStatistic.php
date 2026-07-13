<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeStatistic extends Model
{
    protected $fillable = [
        'key',
        'value',
        'label',
        'sort_order',
        'is_active',
    ];
}