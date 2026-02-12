<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentController;


Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/incidents', [IncidentController::class, 'index'])
    ->name('incidents.index');

Route::get('/incidents/create', [IncidentController::class, 'create'])
    ->name('incidents.create');

Route::post('/incidents', [IncidentController::class, 'store'])
    ->name('incidents.store');

Route::get('/incidents/{incident}/edit', [IncidentController::class, 'edit'])
    ->name('incidents.edit');

Route::put('/incidents/{incident}', [IncidentController::class, 'update'])
    ->name('incidents.update');

Route::redirect('/incidents/index', '/incidents');
Route::get('/incidents/{incident}', [IncidentController::class, 'show'])->name('incidents.show');
