<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Kolom yang disembunyikan ketika model diubah menjadi array atau JSON.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi tipe atribut model.
     *
     * Cast "hashed" memastikan kata sandi selalu disimpan dalam bentuk hash
     * dan tidak melakukan hashing ulang terhadap nilai yang sudah di-hash.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Normalisasi nama admin.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: static fn (mixed $value): string => trim(
                (string) $value
            ),
        );
    }

    /**
     * Normalisasi email admin.
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: static fn (mixed $value): string => Str::lower(
                trim((string) $value)
            ),
        );
    }
}