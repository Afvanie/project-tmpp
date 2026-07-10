<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\LecturerStaffController;
use App\Http\Controllers\Frontend\AcademicController;
use App\Http\Controllers\Frontend\FacilityController;
use App\Http\Controllers\Frontend\ContactController;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminUserController;

use App\Http\Controllers\Admin\LecturerStaffController as AdminLecturerStaffController;
use App\Http\Controllers\Admin\LecturerStaffImportController;

use App\Http\Controllers\Admin\AcademicDocumentController as AdminAcademicDocumentController;
use App\Http\Controllers\Admin\ProfileContentController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;
use App\Http\Controllers\Admin\AccreditationController as AdminAccreditationController;


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile');

Route::get('/lecturers', [LecturerStaffController::class, 'index'])
    ->name('lecturers');

Route::redirect('/dosen-staff', '/lecturers');

Route::get('/academic', [AcademicController::class, 'index'])
    ->name('academic');

Route::get('/academic/{slug}', [AcademicController::class, 'page'])
    ->name('academic.page');

Route::get('/facilities', [FacilityController::class, 'index'])
    ->name('facilities');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Admin Auth
    |--------------------------------------------------------------------------
    */

    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.post');


    /*
    |--------------------------------------------------------------------------
    | Protected Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin.auth')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');


        /*
        |--------------------------------------------------------------------------
        | Pengelola Admin
        |--------------------------------------------------------------------------
        */

        Route::resource('admin-users', AdminUserController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | Dosen & Staff
        |--------------------------------------------------------------------------
        */

        Route::get('lecturer-staff/template', [LecturerStaffImportController::class, 'template'])
            ->name('lecturer-staff.template');

        Route::post('lecturer-staff/import/{type}', [LecturerStaffImportController::class, 'import'])
            ->whereIn('type', ['dosen', 'staff'])
            ->name('lecturer-staff.import');

        Route::resource('lecturer-staff', AdminLecturerStaffController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | Akademik
        |--------------------------------------------------------------------------
        */

        Route::resource('academic-documents', AdminAcademicDocumentController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | Konten Profil
        |--------------------------------------------------------------------------
        */

        Route::get('/profile-contents', [ProfileContentController::class, 'index'])
            ->name('profile-contents.index');

        Route::get('/profile-contents/{profileSection}/edit', [ProfileContentController::class, 'edit'])
            ->name('profile-contents.edit');

        Route::put('/profile-contents/{profileSection}', [ProfileContentController::class, 'update'])
            ->name('profile-contents.update');

        Route::post('/profile-contents/{profileSection}/items', [ProfileContentController::class, 'storeItem'])
            ->name('profile-contents.items.store');

        Route::put('/profile-items/{profileItem}', [ProfileContentController::class, 'updateItem'])
            ->name('profile-contents.items.update');

        Route::delete('/profile-items/{profileItem}', [ProfileContentController::class, 'destroyItem'])
            ->name('profile-contents.items.destroy');


        /*
        |--------------------------------------------------------------------------
        | Akreditasi
        |--------------------------------------------------------------------------
        */

        Route::resource('accreditations', AdminAccreditationController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | Dokumentasi Fasilitas
        |--------------------------------------------------------------------------
        */

        Route::get('/facilities', [AdminFacilityController::class, 'index'])
            ->name('facilities.index');

        Route::post('/facility-photos', [AdminFacilityController::class, 'storePhotoGeneral'])
            ->name('facilities.photos.store-general');

        Route::get('/facilities/{facility}/edit', [AdminFacilityController::class, 'edit'])
            ->name('facilities.edit');

        Route::post('/facilities/{facility}/photos', [AdminFacilityController::class, 'storePhoto'])
            ->name('facilities.photos.store');

        Route::put('/facility-photos/{facilityPhoto}', [AdminFacilityController::class, 'updatePhoto'])
            ->name('facilities.photos.update');

        Route::delete('/facility-photos/{facilityPhoto}', [AdminFacilityController::class, 'destroyPhoto'])
            ->name('facilities.photos.destroy');

    });

});