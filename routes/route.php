<?php

namespace parzival42codes\LaravelArtisanAsJob;

use Illuminate\Support\Facades\Route;
use parzival42codes\LaravelArtisanAsJob\App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['web', 'auth'])
    ->group(function () {
        Route::get('artisan-as-job', [DashboardController::class, 'index'])
            ->name('artisan-as-job.dashboard');

        Route::post('artisan-as-job', [DashboardController::class, 'cmd'])
            ->name('artisan-as-job.dashboard');
    });
