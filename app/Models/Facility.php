<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    /*
    |--------------------------------------------------------------------------
    | KATEGORI FASILITAS
    |--------------------------------------------------------------------------
    */

    public const CATEGORY_LABORATORY = 'laboratorium';

    public const CATEGORY_WORKSHOP = 'workshop';

    public const CATEGORY_CLASSROOM = 'ruang_kelas';

    public const CATEGORY_GALLERY = 'galeri';

    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'category',
        'title',
        'description',
        'sort_order',
        'is_active',
    ];

    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function photos(): HasMany
    {
        return $this
            ->hasMany(FacilityPhoto::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORY OPTIONS
    |--------------------------------------------------------------------------
    */

    public static function categories(): array
    {
        return [
            self::CATEGORY_LABORATORY =>
                'Ruang Laboratorium',

            self::CATEGORY_WORKSHOP =>
                'Ruang Workshop',

            self::CATEGORY_CLASSROOM =>
                'Ruang Kelas',

            self::CATEGORY_GALLERY =>
                'Galeri Aktivitas Mahasiswa',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORY LABEL
    |--------------------------------------------------------------------------
    */

    public function getCategoryLabelAttribute(): string
    {
        return self::categories()[$this->category]
            ?? $this->category;
    }

    /*
    |--------------------------------------------------------------------------
    | CATEGORY VALIDATION
    |--------------------------------------------------------------------------
    */

    public static function isValidCategory(string $category): bool
    {
        return array_key_exists(
            $category,
            self::categories()
        );
    }
}