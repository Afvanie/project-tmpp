<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Accreditation extends Model
{
    public const TYPE_NATIONAL = 'nasional';

    public const TYPE_INTERNATIONAL = 'internasional';

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'type',
        'institution',
        'rank',
        'certificate_number',
        'valid_from',
        'valid_until',
        'file_path',
        'description',
        'is_active',
        'sort_order',
    ];

    /**
     * Konversi tipe atribut model.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'valid_from' => 'date',
            'valid_until' => 'date',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    /**
     * Daftar jenis akreditasi yang diperbolehkan.
     *
     * @return array<string, string>
     */
    public static function types(): array
    {
        return [
            self::TYPE_NATIONAL =>
                'Akreditasi Nasional',

            self::TYPE_INTERNATIONAL =>
                'Akreditasi Internasional',
        ];
    }

    /**
     * Memeriksa validitas nilai jenis akreditasi.
     */
    public static function isValidType(
        mixed $type
    ): bool {
        return is_string($type)
            && array_key_exists(
                $type,
                self::types()
            );
    }

    /**
     * Label jenis akreditasi untuk tampilan.
     */
    protected function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn (): string =>
                self::types()[$this->type]
                ?? (string) $this->type,
        );
    }

    /**
     * Hanya mengambil data yang dipublikasikan.
     */
    public function scopeActive(
        Builder $query
    ): Builder {
        return $query->where(
            'is_active',
            true
        );
    }

    /**
     * Mengurutkan data untuk tampilan.
     */
    public function scopeOrdered(
        Builder $query
    ): Builder {
        return $query
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->orderByDesc('id');
    }
}