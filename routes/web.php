<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\IncidentMapController;

use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('incidents/export/pdf', [IncidentController::class, 'exportPdf'])->name('incidents.export.pdf');
Route::get('/incidents/map', [IncidentMapController::class, 'index'])->name('incidents.map.index');
Route::post('/incidents/map/refresh', [IncidentMapController::class, 'refresh'])->name('incidents.map.refresh');
Route::resource('incidents', IncidentController::class);
Route::resource('locations', LocationController::class);
Route::resource('types', TypeController::class);




require __DIR__ . '/auth.php';
