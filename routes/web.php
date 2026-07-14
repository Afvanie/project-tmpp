<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\AccreditationController as AdminAccreditationController;
use App\Http\Controllers\Admin\AcademicDocumentController as AdminAcademicDocumentController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\HomeContentController as AdminHomeContentController;
use App\Http\Controllers\Admin\LecturerStaffController as AdminLecturerStaffController;
use App\Http\Controllers\Admin\LecturerStaffImportController;
use App\Http\Controllers\Admin\ProfileContentController;
use App\Http\Controllers\Frontend\AcademicController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\FacilityController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LecturerStaffController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Beranda
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [
        HomeController::class,
        'index',
    ]
)->name('home');


/*
|--------------------------------------------------------------------------
| Profil Program Studi
|--------------------------------------------------------------------------
*/

Route::get(
    '/profile',
    [
        ProfileController::class,
        'index',
    ]
)->name('profile');


/*
|--------------------------------------------------------------------------
| Dosen dan Staf
|--------------------------------------------------------------------------
*/

Route::get(
    '/lecturers',
    [
        LecturerStaffController::class,
        'index',
    ]
)->name('lecturers');

/*
|--------------------------------------------------------------------------
| Alias URL
|--------------------------------------------------------------------------
|
| Route utama tetap menggunakan /lecturers untuk menjaga kompatibilitas
| dengan tautan yang telah digunakan sebelumnya.
|
*/

Route::permanentRedirect(
    '/dosen-staf',
    '/lecturers'
);

Route::permanentRedirect(
    '/dosen-staff',
    '/lecturers'
);


/*
|--------------------------------------------------------------------------
| Akademik
|--------------------------------------------------------------------------
*/

Route::get(
    '/academic',
    [
        AcademicController::class,
        'index',
    ]
)->name('academic');

Route::get(
    '/academic/{slug}',
    [
        AcademicController::class,
        'page',
    ]
)
    ->where(
        'slug',
        '[A-Za-z0-9\-]+'
    )
    ->name('academic.page');


/*
|--------------------------------------------------------------------------
| Fasilitas
|--------------------------------------------------------------------------
*/

Route::get(
    '/facilities',
    [
        FacilityController::class,
        'index',
    ]
)->name('facilities');


/*
|--------------------------------------------------------------------------
| Kontak
|--------------------------------------------------------------------------
*/

Route::get(
    '/contact',
    [
        ContactController::class,
        'index',
    ]
)->name('contact');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function (): void {

        /*
        |--------------------------------------------------------------------------
        | Autentikasi
        |--------------------------------------------------------------------------
        */

        Route::get(
            'login',
            [
                AdminAuthController::class,
                'showLogin',
            ]
        )->name('login');

        Route::post(
            'login',
            [
                AdminAuthController::class,
                'login',
            ]
        )->name('login.post');


        /*
        |--------------------------------------------------------------------------
        | Halaman Terproteksi
        |--------------------------------------------------------------------------
        */

        Route::middleware('admin.auth')
            ->group(function (): void {

                /*
                |--------------------------------------------------------------------------
                | Dashboard
                |--------------------------------------------------------------------------
                */

                Route::get(
                    '/',
                    [
                        DashboardController::class,
                        'index',
                    ]
                )->name('dashboard');

                Route::post(
                    'logout',
                    [
                        AdminAuthController::class,
                        'logout',
                    ]
                )->name('logout');


                /*
                |--------------------------------------------------------------------------
                | Akun Pengelola Admin
                |--------------------------------------------------------------------------
                */

                Route::resource(
                    'admin-users',
                    AdminUserController::class
                )->except([
                    'show',
                ]);


                /*
                |--------------------------------------------------------------------------
                | Dosen dan Staf
                |--------------------------------------------------------------------------
                */

                Route::get(
                    'lecturer-staff/template',
                    [
                        LecturerStaffImportController::class,
                        'template',
                    ]
                )->name('lecturer-staff.template');

                Route::post(
                    'lecturer-staff/import/{type}',
                    [
                        LecturerStaffImportController::class,
                        'import',
                    ]
                )
                    ->whereIn(
                        'type',
                        [
                            'dosen',
                            'staff',
                        ]
                    )
                    ->name('lecturer-staff.import');

                Route::resource(
                    'lecturer-staff',
                    AdminLecturerStaffController::class
                )->except([
                    'show',
                ]);


                /*
                |--------------------------------------------------------------------------
                | Dokumen Akademik
                |--------------------------------------------------------------------------
                */

                Route::resource(
                    'academic-documents',
                    AdminAcademicDocumentController::class
                )->except([
                    'show',
                ]);


                /*
                |--------------------------------------------------------------------------
                | Konten Profil
                |--------------------------------------------------------------------------
                */

                Route::get(
                    'profile-contents',
                    [
                        ProfileContentController::class,
                        'index',
                    ]
                )->name('profile-contents.index');

                Route::get(
                    'profile-contents/{profileSection}/edit',
                    [
                        ProfileContentController::class,
                        'edit',
                    ]
                )->name('profile-contents.edit');

                Route::put(
                    'profile-contents/{profileSection}',
                    [
                        ProfileContentController::class,
                        'update',
                    ]
                )->name('profile-contents.update');

                Route::post(
                    'profile-contents/{profileSection}/items',
                    [
                        ProfileContentController::class,
                        'storeItem',
                    ]
                )->name(
                    'profile-contents.items.store'
                );

                Route::put(
                    'profile-items/{profileItem}',
                    [
                        ProfileContentController::class,
                        'updateItem',
                    ]
                )->name(
                    'profile-contents.items.update'
                );

                Route::delete(
                    'profile-items/{profileItem}',
                    [
                        ProfileContentController::class,
                        'destroyItem',
                    ]
                )->name(
                    'profile-contents.items.destroy'
                );


                /*
                |--------------------------------------------------------------------------
                | Akreditasi
                |--------------------------------------------------------------------------
                */

                Route::resource(
                    'accreditations',
                    AdminAccreditationController::class
                )->except([
                    'show',
                ]);


                /*
                |--------------------------------------------------------------------------
                | Dokumentasi Fasilitas
                |--------------------------------------------------------------------------
                */

                Route::get(
                    'facilities',
                    [
                        AdminFacilityController::class,
                        'index',
                    ]
                )->name('facilities.index');

                /*
                | Digunakan oleh formulir unggah cepat pada halaman
                | daftar fasilitas.
                */

                Route::post(
                    'facility-photos',
                    [
                        AdminFacilityController::class,
                        'storePhotoGeneral',
                    ]
                )->name(
                    'facilities.photos.store-general'
                );

                Route::get(
                    'facilities/{facility}/edit',
                    [
                        AdminFacilityController::class,
                        'edit',
                    ]
                )->name('facilities.edit');

                /*
                | Memperbarui judul, deskripsi, urutan, dan status
                | kategori fasilitas.
                */

                Route::put(
                    'facilities/{facility}',
                    [
                        AdminFacilityController::class,
                        'update',
                    ]
                )->name('facilities.update');

                Route::post(
                    'facilities/{facility}/photos',
                    [
                        AdminFacilityController::class,
                        'storePhoto',
                    ]
                )->name(
                    'facilities.photos.store'
                );

                Route::put(
                    'facility-photos/{facilityPhoto}',
                    [
                        AdminFacilityController::class,
                        'updatePhoto',
                    ]
                )->name(
                    'facilities.photos.update'
                );

                Route::delete(
                    'facility-photos/{facilityPhoto}',
                    [
                        AdminFacilityController::class,
                        'destroyPhoto',
                    ]
                )->name(
                    'facilities.photos.destroy'
                );


                /*
                |--------------------------------------------------------------------------
                | Konten Beranda
                |--------------------------------------------------------------------------
                */

                Route::get(
                    'home-content',
                    [
                        AdminHomeContentController::class,
                        'index',
                    ]
                )->name('home-content.index');

                Route::put(
                    'home-content',
                    [
                        AdminHomeContentController::class,
                        'update',
                    ]
                )->name('home-content.update');
            });
    });