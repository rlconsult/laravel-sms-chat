<?php

use Illuminate\Support\Facades\Route;
use Filament\Features;
use Filament\Http\Controllers\{
    AssetController,
};

$routeNamePrefix = config('filament.prefix.name', 'filament.');

Route::group([
    'prefix' => config('filament.prefix.route'),
    'middleware' => config('filament.middleware', ['web']),
    'as' => $routeNamePrefix,
], function () use ($routeNamePrefix) {
    // Assets
    Route::name('assets.')->group(function () {
        Route::get('filament.css', [AssetController::class, 'css'])->name('css');
        Route::get('filament.css.map', [AssetController::class, 'cssMap']);
        Route::get('filament.js', [AssetController::class, 'js'])->name('js');   
        Route::get('filament.js.map', [AssetController::class, 'jsMap']);  
    });

    // Auth
    Route::get('/login', config('filament.livewire.login'))->name('login');

    // Authenticated routes
    Route::group(['middleware' => ['auth', 'verified']], function () {
        // User profile
        Route::get('/profile', config('filament.livewire.profile'))->name('profile');

        // Users
        if (Features::managesUsers()) {
            Route::name('users.')->group(function () {
                Route::get('/users', config('filament.livewire.users'))->name('index');
                Route::get('/user/{user}', config('filament.livewire.user'))->name('show');
            });
        }
    });
});

// Conditional route login alias
if (!Route::has('login')) {
    Route::get('/login', function () use ($routeNamePrefix) {
        return redirect()->route("{$routeNamePrefix}login");
    })->name('login');
}