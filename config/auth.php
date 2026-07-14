<?php

declare(strict_types=1);

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Autentikasi admin pada proyek ini menggunakan session khusus:
    |
    | - admin_id
    | - admin_name
    | - admin_email
    |
    | Oleh karena itu, konfigurasi guard Laravel tetap digunakan hanya
    | untuk autentikasi web bawaan apabila dibutuhkan.
    |
    */

    'defaults' => [
        'guard' => env(
            'AUTH_GUARD',
            'web'
        ),

        'passwords' => env(
            'AUTH_PASSWORD_BROKER',
            'users'
        ),
    ],


    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',

            'model' => env(
                'AUTH_MODEL',
                User::class
            ),
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Password Reset
    |--------------------------------------------------------------------------
    |
    | Fitur reset kata sandi admin belum tersedia. Konfigurasi ini tetap
    | dipertahankan untuk sistem pengguna Laravel bawaan.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',

            'table' => env(
                'AUTH_PASSWORD_RESET_TOKEN_TABLE',
                'password_reset_tokens'
            ),

            'expire' => 60,
            'throttle' => 60,
        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env(
        'AUTH_PASSWORD_TIMEOUT',
        10800
    ),

];