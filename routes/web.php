<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('index');
})->name('home');

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

    // Administrator Routes
    Route::middleware(['role:Super Admin'])->prefix('administrator')->name('admin.')->group(function () {
        Route::get('/users', \App\Livewire\Administrator\ManageUsers::class)->name('users');
        Route::get('/roles', \App\Livewire\Administrator\ManageRoles::class)->name('roles');
        Route::get('/permissions', \App\Livewire\Administrator\ManagePermissions::class)->name('permissions');
    });

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
