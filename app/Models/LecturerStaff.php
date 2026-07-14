<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LecturerStaff extends Model
{
    /*
    |--------------------------------------------------------------------------
    | JENIS DATA
    |--------------------------------------------------------------------------
    |
    | Nilai ini digunakan secara internal pada database, controller,
    | filter, dan proses import.
    |
    */

    public const TYPE_DOSEN = 'dosen';

    public const TYPE_STAFF = 'staff';


    /*
    |--------------------------------------------------------------------------
    | KONFIGURASI MODEL
    |--------------------------------------------------------------------------
    */

    protected $table = 'lecturer_staff';

    protected $fillable = [
        'name',
        'nip',
        'photo',
        'type',
    ];


    /*
    |--------------------------------------------------------------------------
    | DAFTAR JENIS
    |--------------------------------------------------------------------------
    |
    | Key disimpan di database.
    | Value ditampilkan kepada pengguna.
    |
    */

    public static function types(): array
    {
        return [
            self::TYPE_DOSEN => 'Dosen',
            self::TYPE_STAFF => 'Staf',
        ];
    }


    /*
    |--------------------------------------------------------------------------
    | LABEL JENIS
    |--------------------------------------------------------------------------
    |
    | Pemanggilan:
    |
    | $lecturerStaff->type_label
    |
    */

    public function getTypeLabelAttribute(): string
    {
        return self::types()[$this->type]
            ?? str((string) $this->type)
                ->replace('_', ' ')
                ->title()
                ->toString();
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPE DOSEN
    |--------------------------------------------------------------------------
    */

    public function scopeDosen(Builder $query): Builder
    {
        return $query->where(
            'type',
            self::TYPE_DOSEN
        );
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPE STAF
    |--------------------------------------------------------------------------
    */

    public function scopeStaff(Builder $query): Builder
    {
        return $query->where(
            'type',
            self::TYPE_STAFF
        );
    }
}