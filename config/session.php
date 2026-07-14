<?php

declare(strict_types=1);

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Session Driver
    |--------------------------------------------------------------------------
    |
    | Proyek menggunakan session untuk autentikasi admin melalui:
    |
    | - admin_id
    | - admin_name
    | - admin_email
    |
    | Driver database mengharuskan tabel "sessions" tersedia.
    |
    */

    'driver' => env(
        'SESSION_DRIVER',
        'database'
    ),


    /*
    |--------------------------------------------------------------------------
    | Session Lifetime
    |--------------------------------------------------------------------------
    |
    | Nilai menggunakan satuan menit. Session akan kedaluwarsa ketika
    | tidak digunakan selama waktu yang ditentukan.
    |
    */

    'lifetime' => (int) env(
        'SESSION_LIFETIME',
        120
    ),

    'expire_on_close' => env(
        'SESSION_EXPIRE_ON_CLOSE',
        false
    ),


    /*
    |--------------------------------------------------------------------------
    | Session Encryption
    |--------------------------------------------------------------------------
    */

    'encrypt' => env(
        'SESSION_ENCRYPT',
        false
    ),


    /*
    |--------------------------------------------------------------------------
    | Session File Location
    |--------------------------------------------------------------------------
    |
    | Digunakan hanya ketika SESSION_DRIVER=file.
    |
    */

    'files' => storage_path(
        'framework/sessions'
    ),


    /*
    |--------------------------------------------------------------------------
    | Session Database Connection
    |--------------------------------------------------------------------------
    */

    'connection' => env(
        'SESSION_CONNECTION'
    ),


    /*
    |--------------------------------------------------------------------------
    | Session Database Table
    |--------------------------------------------------------------------------
    */

    'table' => env(
        'SESSION_TABLE',
        'sessions'
    ),


    /*
    |--------------------------------------------------------------------------
    | Session Cache Store
    |--------------------------------------------------------------------------
    |
    | Digunakan oleh driver cache seperti Redis, Memcached, atau DynamoDB.
    |
    */

    'store' => env(
        'SESSION_STORE'
    ),


    /*
    |--------------------------------------------------------------------------
    | Session Sweeping Lottery
    |--------------------------------------------------------------------------
    */

    'lottery' => [
        2,
        100,
    ],


    /*
    |--------------------------------------------------------------------------
    | Session Cookie Name
    |--------------------------------------------------------------------------
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(
            (string) env(
                'APP_NAME',
                'laravel'
            )
        ) . '-session'
    ),


    /*
    |--------------------------------------------------------------------------
    | Session Cookie Path
    |--------------------------------------------------------------------------
    */

    'path' => env(
        'SESSION_PATH',
        '/'
    ),


    /*
    |--------------------------------------------------------------------------
    | Session Cookie Domain
    |--------------------------------------------------------------------------
    */

    'domain' => env(
        'SESSION_DOMAIN'
    ),


    /*
    |--------------------------------------------------------------------------
    | HTTPS Only Cookies
    |--------------------------------------------------------------------------
    |
    | Atur SESSION_SECURE_COOKIE=true ketika website sudah menggunakan HTTPS
    | pada server produksi.
    |
    */

    'secure' => env(
        'SESSION_SECURE_COOKIE'
    ),


    /*
    |--------------------------------------------------------------------------
    | HTTP Only Cookies
    |--------------------------------------------------------------------------
    |
    | Mencegah JavaScript membaca cookie session.
    |
    */

    'http_only' => env(
        'SESSION_HTTP_ONLY',
        true
    ),


    /*
    |--------------------------------------------------------------------------
    | Same-Site Cookies
    |--------------------------------------------------------------------------
    */

    'same_site' => env(
        'SESSION_SAME_SITE',
        'lax'
    ),


    /*
    |--------------------------------------------------------------------------
    | Partitioned Cookies
    |--------------------------------------------------------------------------
    */

    'partitioned' => env(
        'SESSION_PARTITIONED_COOKIE',
        false
    ),


    /*
    |--------------------------------------------------------------------------
    | Session Serialization
    |--------------------------------------------------------------------------
    |
    | Session admin hanya menyimpan nilai skalar seperti ID, nama, dan email,
    | sehingga format JSON sesuai untuk proyek ini.
    |
    */

    'serialization' => env(
        'SESSION_SERIALIZATION',
        'json'
    ),

];