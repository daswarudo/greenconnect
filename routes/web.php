<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', function () {
    return view('welcome');//change to login to view login, welcome=dashboard
});

Route::get('/welcome', function () {//dashboard
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signUp', function () {
    return view('signUp');
})->name('signUp');

Route::get('/subscribers', function () {
    return view('subscribers');
})->name('subscribers');

Route::get('/rdnDashboard', function () {
    return view('rdnDashboard');
})->name('rdnDashboard');

Route::get('/appointments', function () {
    return view('appointments');
})->name('appointments');

Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);


Route::get('/mealplans', function () {
    return view('mealplans');
})->name('mealplans');



