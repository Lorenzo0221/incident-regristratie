<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\IncidentMapController;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/incidents/stats', [IncidentController::class, 'stats'])->name('incidents.stats');
    Route::get('incidents/export/pdf', [IncidentController::class, 'exportPdf'])->name('incidents.export.pdf');
    Route::get('/incidents/map', [IncidentMapController::class, 'index'])->name('incidents.map.index');
    Route::post('/incidents/map/refresh', [IncidentMapController::class, 'refresh'])->name('incidents.map.refresh');
    Route::resource('incidents', IncidentController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('types', TypeController::class);

    Route::middleware('admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});

Route::redirect('/incidents/index', '/incidents');

require __DIR__ . '/auth.php';
