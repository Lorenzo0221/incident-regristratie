<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentController;

Route::get('/', function () {
    return view('welcome');
});

// Minimal named login route to satisfy `auth` middleware redirects.
Route::get('/login', function () {
    return redirect('/');
})->name('login');

// Redirect legacy or mistyped /incidents/index to the canonical /incidents route.
Route::redirect('/incidents/index', '/incidents');



Route::middleware('auth')->group(function () {
    Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents.index');
    Route::get('/incidents/create', [IncidentController::class, 'create'])->name('incidents.create');
    // Route::post('/incidents', [IncidentController::class, 'store'])->name('incidents.store');
    // hoi test lorenxxoo!!!
}); 