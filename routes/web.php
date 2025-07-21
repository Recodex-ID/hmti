<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('home');

Route::get('/departemen/{department}', [\App\Http\Controllers\DepartemenController::class, 'show'])->name('departemen.show');

Route::get('/community/{community}', [\App\Http\Controllers\CommunityController::class, 'show'])->name('community.show');

// Routes untuk menu Profil
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/tentang-kami', [\App\Http\Controllers\ProfilController::class, 'tentangKami'])->name('tentang-kami');
    Route::get('/ad-art', [\App\Http\Controllers\ProfilController::class, 'adArt'])->name('ad-art');
    Route::get('/panduan-logo', [\App\Http\Controllers\ProfilController::class, 'panduanLogo'])->name('panduan-logo');
    Route::get('/grand-design', [\App\Http\Controllers\ProfilController::class, 'grandDesign'])->name('grand-design');
    Route::get('/hut-hmti', [\App\Http\Controllers\ProfilController::class, 'hutHmti'])->name('hut-hmti');
    Route::get('/sejarah', [\App\Http\Controllers\ProfilController::class, 'sejarah'])->name('sejarah');
});

// Routes untuk menu Partnership
Route::prefix('partnership')->name('partnership.')->group(function () {
    Route::get('/benchmark', [\App\Http\Controllers\PartnershipController::class, 'benchmark'])->name('benchmark');
    Route::get('/media-partner', [\App\Http\Controllers\PartnershipController::class, 'mediaPartner'])->name('media-partner');
    Route::get('/mc-moderator', [\App\Http\Controllers\PartnershipController::class, 'mcModerator'])->name('mc-moderator');
});

// Routes untuk menu MPM
Route::prefix('mpm')->name('mpm.')->group(function () {
    Route::get('/komisi-a', [\App\Http\Controllers\MpmController::class, 'komisiA'])->name('komisi-a');
    Route::get('/komisi-b', [\App\Http\Controllers\MpmController::class, 'komisiB'])->name('komisi-b');
    Route::get('/komisi-c', [\App\Http\Controllers\MpmController::class, 'komisiC'])->name('komisi-c');
    Route::get('/burt', [\App\Http\Controllers\MpmController::class, 'burt'])->name('burt');
});

Route::get('/dashboard', \App\Livewire\Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Department Management Routes
    Route::get('/departments', \App\Livewire\ManageDepartments::class)->name('departments');

    // Community Management Routes
    Route::get('/communities', \App\Livewire\ManageCommunities::class)->name('communities');

    // Core Management Routes
    Route::get('/cores', \App\Livewire\ManageCores::class)->name('cores');

    // Hero Management Routes
    Route::get('/heroes', \App\Livewire\ManageHeroes::class)->name('heroes');

    // About Management Routes
    Route::get('/about', \App\Livewire\ManageAbout::class)->name('about');

    // Information Management Routes
    Route::get('/circular-letters', \App\Livewire\ManageCircularLetters::class)->name('circular-letters');
    Route::get('/activity-information', \App\Livewire\ManageActivityInformation::class)->name('activity-information');
    Route::get('/competition-information', \App\Livewire\ManageCompetitionInformation::class)->name('competition-information');
    Route::get('/news', \App\Livewire\ManageNews::class)->name('news');

    // Administrator Routes
    Route::middleware(['role:Super Admin'])->prefix('administrator')->name('admin.')->group(function () {
        Route::get('/users', \App\Livewire\Administrator\ManageUsers::class)->name('users');
        Route::get('/roles', \App\Livewire\Administrator\ManageRoles::class)->name('roles');
    });

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
