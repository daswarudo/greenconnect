<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CustomerController;

//RND

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

Route::get('/viewsubscriber', function () {
    return view('viewsubscriber');
})->name('viewsubscriber');



// CUSTOMERS

Route::get('/customerDashboard', function () {
    return view('customerDashboard');
})->name('customerDashboard');

// LACKING ROUTE SA CUSTOMER APPOINTMENT UNKNOWN PAMAN 

Route::get('/customerFeedback', function () {
    return view('customerFeedback');
})->name('customerFeedback');

Route::get('/customerSubscription', function () {
    return view('customerSubscription');
})->name('customerSubscription');

//SignUp
Route::post('/register-customer', [CustomerController::class, 'store'])->name('customer.store');