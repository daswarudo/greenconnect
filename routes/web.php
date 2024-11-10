<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginRegisterController;


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

Route::get('/homeMealInput', function () {
    return view('homeMealInput');
})->name('homeMealInput');

Route::get('/restoMealInput', function () {
    return view('restoMealInput');
})->name('restoMealInput');

// LACKING ROUTE SA CUSTOMER APPOINTMENT UNKNOWN PAMAN 

Route::get('/customerFeedback', function () {
    return view('customerFeedback');
})->name('customerFeedback');

Route::get('/customerSubscription', function () {
    return view('customerSubscription');
})->name('customerSubscription');

//backend
//Route::get('/signUp', [LoginRegisterController::class, 'showSignUpPage'])->name('signUp');
Route::get('/signUp',[LoginRegisterController::class,'viewSubs'])->name('view.subscriptions');
Route::post('/signUp',[LoginRegisterController::class,'register'])->name('register.customer');

Route::post('/login', [LoginRegisterController::class, 'loginUser'])->name('login.user');

//rdn
Route::get('/rdnDashboard', [LoginRegisterController::class, 'showSubscriptions'])->name('rdnDashboard');
Route::get('/subscribers', [LoginRegisterController::class, 'showSubscriptions'])->name('subscribers');


Route::patch('/rdnDashboard', [LoginRegisterController::class, 'updateStatus'])
    ->name('subscriptions.updateStatus');




//login customer
