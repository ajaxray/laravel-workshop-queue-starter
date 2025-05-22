<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\AccountOpenForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Account Applications
    Route::get('/account-applications', \App\Livewire\AccountApplications\Index::class)->name('account-applications.index');
    Route::get('/account-applications/create', \App\Livewire\AccountApplications\Create::class)->name('account-applications.create');
    Route::get('/account-applications/show/{accountApplication}', \App\Livewire\AccountApplications\Show::class)->name('account-applications.show');
    Route::get('/account-applications/update/{accountApplication}', \App\Livewire\AccountApplications\Edit::class)->name('account-applications.edit');

    Route::get('/media/{accountApplication}/{media}/{conversion?}', [\App\Http\Controllers\MediaController::class, 'show'])->name('media.account-application.show');
});

Route::get('open-account', AccountOpenForm::class)->name('account.open');

require __DIR__.'/auth.php';
