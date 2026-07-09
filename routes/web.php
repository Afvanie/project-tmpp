<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\LecturerController;
use App\Http\Controllers\Frontend\AcademicController;
use App\Http\Controllers\Frontend\FacilityController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\LecturerStaffController;
use App\Http\Controllers\Admin\LecturerStaffController as AdminLecturerStaffController;
use App\Http\Controllers\Admin\AcademicDocumentController as AdminAcademicDocumentController;
use App\Http\Controllers\Admin\ProfileContentController;
use App\Http\Controllers\Admin\FacilityController as AdminFacilityController;

use App\Http\Controllers\Admin\AuthController as AdminAuthController;

use App\Http\Controllers\Admin\AdminUserController;


Route::get('/dosen-staff', [LecturerController::class, 'index'])
    ->name('lecturers');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/lecturers', [LecturerController::class, 'index'])->name('lecturers');

Route::get('/academic', [AcademicController::class, 'index'])->name('academic');

Route::get('/facilities', [FacilityController::class, 'index'])->name('facilities');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/lecturers', [LecturerStaffController::class, 'index'])->name('lecturers');

// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('lecturer-staff', AdminLecturerStaffController::class)
//         ->except(['show']);
//     Route::resource('academic-documents', AdminAcademicDocumentController::class)
//     ->except(['show']);
// });

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');

    Route::resource('admin-users', AdminUserController::class)
    ->except(['show']);
    
    Route::middleware('admin.auth')->group(function () {

        Route::get('/', function () {
            return redirect()->route('admin.lecturer-staff.index');
        })->name('dashboard');

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::resource('lecturer-staff', AdminLecturerStaffController::class)
            ->except(['show']);

        Route::resource('academic-documents', AdminAcademicDocumentController::class)
            ->except(['show']);
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

    });
    Route::get('/facilities', [AdminFacilityController::class, 'index'])
        ->name('facilities.index');

    Route::get('/facilities/{facility}/edit', [AdminFacilityController::class, 'edit'])
        ->name('facilities.edit');

    Route::post('/facilities/{facility}/photos', [AdminFacilityController::class, 'storePhoto'])
        ->name('facilities.photos.store');

    Route::put('/facility-photos/{facilityPhoto}', [AdminFacilityController::class, 'updatePhoto'])
        ->name('facilities.photos.update');

    Route::delete('/facility-photos/{facilityPhoto}', [AdminFacilityController::class, 'destroyPhoto'])
        ->name('facilities.photos.destroy');
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

Route::get('/academic', [AcademicController::class, 'index'])->name('academic');


Route::get('/academic/{slug}', [AcademicController::class, 'page'])->name('academic.page');