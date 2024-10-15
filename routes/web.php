<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('rdnDashboard');//change to login to view login, welcome=dashboard
});

Route::get('/welcome', function () {//dashboard
    return view('welcome');
})->name('login');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signUp', function () {
    return view('signUp');
})->name('signUp');

/*Route::get('/sidebar', function () {
    return view('sidebar');
})->name('sidebar');*/

Route::get('/rdnDashboard', function () {
    return view('rdnDashboard');
})->name('rdnDashboard');

Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);





