<?php

use App\Http\Controllers\AppointmentsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RdnDashboardController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\viewsubscriberController;
use App\Http\Controllers\WelcomeController;

//RND

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/welcome', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::get('/signUp', [SignUpController::class, 'index'])->name('signUp');

Route::get('/subscribers', [SubscribersController::class, 'index'])->name('subscribers');

Route::get('/rdnDashboard', [RdnDashboardController::class, 'index'])->name('rdnDashboard');

Route::get('/appointments', [AppointmentsController::class, 'index'])->name('appointments');

Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);


Route::get('/mealplans', [AppointmentsController::class,'index'])->name('mealplans');

Route::get('/viewsubscriber', [viewsubscriberController::class, 'index'])->name('viewsubscriber');



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