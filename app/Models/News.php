<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'image',
        'excerpt',
        'content',
        'published_at',
        'is_active',
    ];

    /**
     * Konversi tipe atribut model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Menggunakan slug untuk route model binding.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Hanya mengambil berita yang sudah dipublikasikan.
     */
    public function scopePublished(
        Builder $query
    ): Builder {
        return $query
            ->where('is_active', true)
            ->whereNotNull('published_at')
            ->where(
                'published_at',
                '<=',
                now()
            );
    }

    /**
     * Mengurutkan berita berdasarkan waktu publikasi terbaru.
     */
    public function scopeLatestPublished(
        Builder $query
    ): Builder {
        return $query
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }
}
