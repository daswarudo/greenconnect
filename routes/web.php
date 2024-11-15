<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MealController;


//RND

Route::get('/', function () {
    return view('welcome');//change to login to view login, welcome=dashboard
});

Route::get('/welcome', function () {//dashboard
    return view('welcome');
})->name('welcome');

Route::get('/test', function () {//dashboard
    return view('test');
})->name('test');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::view('/subscribers', 'subscribers')->name('subscribers');


Route::get('/rdnDashboard', function () {
    return view('rdnDashboard');
})->name('rdnDashboard');

Route::get('/appointments', function () {
    return view('appointments');
})->name('appointments');

//viewAppointmentsRdn
Route::get('/viewAppointmentsRdn', function () {
    return view('viewAppointmentsRdn');
})->name('viewAppointmentsRdn');

Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);
Route::get('/events/{id}', [EventController::class, 'show']);
Route::put('/events/{id}', [EventController::class, 'update']);
Route::delete('/events/{id}', [EventController::class, 'destroy']);

// Route to get events for the calendar
Route::get('/events', [EventController::class, 'getEvents']);

// Route to create a new event
Route::post('/events', [EventController::class, 'createEvent']);

Route::get('/mealplans', function () {
    return view('mealplans');
})->name('mealplans');
Route::get('/mealplansEdit', function () {
    return view('mealplansEdit');
})->name('mealplansEdit');


Route::get('/viewsubscriber', function () {
    return view('viewsubscriber');
})->name('viewsubscriber');

// CUSTOMERS

Route::get('/custTest', [LoginRegisterController::class, 'showCustomerDashboard'])->name('custTest');

Route::get('/customerDashboard', function () {
    return view('customerDashboard');
})->name('customerDashboard');

Route::get('/homeMealInput', function () {
    return view('homeMealInput');
})->name('homeMealInput');

Route::get('/restoMealInput', function () {
    return view('restoMealInput');
})->name('restoMealInput');

// LACKING ROUTE IN CUSTOMER APPOINTMENT SINCE IT IS UNKNOWN 

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


// Route to view customer details

Route::get('/viewsubscriber/edit/{id}', [LoginRegisterController::class, 'viewDetails'])->name('viewSubscriber.view');///EDITS
//goods ning duha controller napud
//Route::put('/subscribers/{id}', [LoginRegisterController::class, 'custEditRnd'])->name('viewSubscriber.custEditRnd');//BUGGY
Route::put('/subscribers/{id}', [LoginRegisterController::class, 'custEditRnd'])->name('viewSubscriber.custEditRnd');


//CONSULTATIONSSSSS
// Show the form to add a new consultation
Route::get('/consultation/create', [ConsultationController::class, 'create'])->name('consultation.create');

// Handle form submission
Route::post('/consultation/store', [ConsultationController::class, 'store'])->name('consultation.store');

Route::get('/appointments', [ConsultationController::class, 'showCalendar'])->name('appointments');

//MEALSssss

Route::get('/mealplans', [MealController::class, 'index'])->name('mealplans');
Route::get('/mealplansAdd', [MealController::class, 'viewSubs'])->name('mealplansAdd');
Route::post('/mealplansAdd',[MealController::class,'addMeals'])->name('mealplans.addition');
//Route::post('/mealplansAdd',[MealController::class,'add'])->name('mealplans.add');//


Route::get('/mealplansEdit/edit/{id}', [MealController::class, 'edit'])->name('meals.edit');
Route::put('/mealplans/{id}', [MealController::class, 'update'])->name('meals.update');
Route::delete('/mealplans/{id}', [MealController::class, 'destroy'])->name('meals.destroy');

//Route::get('/mealplansEdit', [MealController::class, 'viewSubs2'])->name('mealplansEdit');
Route::get('/mealplansEdit/edit/{id}', [MealController::class, 'viewSubs2'])->name('meals.edit');

//login customer
