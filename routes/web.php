<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginRegisterController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MealController;

use App\Http\Middleware\CheckUserType;


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


// middlewared customer

Route::get('/custTest', function () {
    return view('custTest');
})->name('custTest');




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

// LACKING ROUTE IN CUSTOMER APPOINTMENT SINCE IT IS UNKNOWN -> not anymore

Route::get('/customerFeedback', function () {
    return view('customerFeedback');
})->name('customerFeedback');

Route::get('/customerFeedbackAdd', function () {
    return view('customerFeedbackAdd');
})->name('customerFeedbackAdd');

Route::get('/customerView', function () {
    return view('customerView');
})->name('customerView');

Route::get('/customerMeals', function () {
    return view('customerMeals');
})->name('customerMeals');

Route::get('/customerSubscription', function () {
    return view('customerSubscription');
})->name('customerSubscription');

//backend
//Route::get('/signUp', [LoginRegisterController::class, 'showSignUpPage'])->name('signUp');
Route::get('/signUp',[LoginRegisterController::class,'viewSubs'])->name('view.subscriptions');
Route::post('/signUp',[LoginRegisterController::class,'register'])->name('register.customer');

Route::post('/login', [LoginRegisterController::class, 'loginUser'])->name('login.user');
Route::get('/logout', [LoginRegisterController::class, 'logout'])->name('logout');//logout

 //for locking pages

//rdn //->middleware('auth')
Route::view('/subscribers', 'subscribers')->name('subscribers');
Route::middleware('auth:rdn')->get('/rdnDashboard', [LoginRegisterController::class, 'showSubscriptions'])->name('rdnDashboard');
    //lock rdn??
    //Route::get('/rdnDashboard', [LoginRegisterController::class, 'showRdnDashboard'])->name('rdnDashboardLock');//lock test

Route::patch('/rdnDashboard', [LoginRegisterController::class, 'updateStatus'])
        ->name('subscriptions.updateStatus');

Route::get('/custTest', [LoginRegisterController::class, 'showCustomerDashboard'])->name('custTest');//ERROR
// Handle form submission
Route::post('/consultation/store', [ConsultationController::class, 'store'])->name('consultation.store');
//CONSULTATIONSSSSS
// Show the form to add a new consultation
Route::middleware('auth:customer')->get('/consultation/create', [ConsultationController::class, 'create'])->name('consultation.create');
Route::middleware('auth:customer')->get('/customerView', [ConsultationController::class, 'viewCust'])->name('viewCust');
Route::middleware('auth:customer')->put('/customerView/{id}/cust', [LoginRegisterController::class, 'custEdit'])->name('custedit');


//also test
Route::middleware('auth:customer')->get('/customerSubscription', [LoginRegisterController::class, 'viewCustSubs'])->name('viewCustSubs');
Route::middleware('auth:customer')->get('/customerSubscriptionAdd', [LoginRegisterController::class, 'viewSubsCreate'])->name('viewSubsCreate');

Route::middleware('auth:customer')->post('/customerSubscriptionAdd', [LoginRegisterController::class, 'addSubscription'])->name('subscription.add');
Route::middleware('auth:customer')->post('/customerFeedbackAdd', [LoginRegisterController::class, 'storeFeedback'])->name('addFeedback');
Route::middleware('auth:customer')->get('/customerFeedback', [LoginRegisterController::class, 'showMyFeedback'])->name('customerFeedback');

Route::delete('/customerFeedback/{id}', [LoginRegisterController::class, 'destroyFeedback'])->name('feedback.delete');
Route::middleware('auth:customer')->get('/customerMeals', [LoginRegisterController::class, 'getLoggedInCustomerMealDetails'])->name('customerMeals');
//TEST//customerEdit
//Route::middleware('auth:customer')->get('/customerEdit', [ConsultationController::class, 'viewCustEdit'])->name('editCust');
//Route::middleware('auth:customer')->get('/custTest/a', [ConsultationController::class, 'showCalendarCust'])->name('appointments');







//
//R dee en middlewarez
// Route to view customer details
Route::middleware('auth:rdn')->get('/subscribers', [LoginRegisterController::class, 'showSubscriptions'])->name('subscribers');
Route::middleware('auth:rdn')->get('/viewsubscriber/edit/{id}', [LoginRegisterController::class, 'viewDetails'])->name('viewSubscriber.view');///EDITS

///EDIT SUBS SA CUST
Route::middleware('auth:rdn')->get('/viewSubscription/edit/{id}', [LoginRegisterController::class, 'edit'])->name('editSubscription');
Route::middleware('auth:rdn')->put('/subscribers/{id}/cust', [LoginRegisterController::class, 'custEditRnd'])->name('viewSubscriber.custEditRnd');
Route::middleware('auth:rdn')->put('/subscribers/{id}/subs', [LoginRegisterController::class, 'update'])->name('updateSubscription');

Route::middleware('auth:rdn')->get('/appointments', [ConsultationController::class, 'showCalendar'])->name('appointments');
Route::middleware('auth:rdn')->get('/viewAppointmentsRdn', [ConsultationController::class, 'index'])->name('viewAppointmentsRdn');
Route::middleware('auth:rdn')->get('/viewAppointmentsRdnEdit/edit/{id}', [ConsultationController::class, 'edit'])->name('viewAppointmentsRdnEdit.edit');
Route::middleware('auth:rdn')->put('/viewAppointmentsRdn/{id}', [ConsultationController::class, 'update'])->name('consultations.update');//krazy routing bug

//MEALSssss
Route::middleware('auth:rdn')->get('/mealplans', [MealController::class, 'index'])->name('mealplans');
Route::middleware('auth:rdn')->get('/mealplansAdd', [MealController::class, 'viewSubs'])->name('mealplansAdd');
Route::middleware('auth:rdn')->post('/mealplansAdd',[MealController::class,'addMeals'])->name('mealplans.addition');
//Route::post('/mealplansAdd',[MealController::class,'add'])->name('mealplans.add');//

Route::middleware('auth:rdn')->get('/mealplansEdit/edit/{id}', [MealController::class, 'edit'])->name('meals.edit');
Route::middleware('auth:rdn')->put('/mealplans/{id}', [MealController::class, 'update'])->name('meals.update');
Route::middleware('auth:rdn')->delete('/mealplans/{id}', [MealController::class, 'destroy'])->name('meals.destroy');

//Route::get('/mealplansEdit', [MealController::class, 'viewSubs2'])->name('mealplansEdit');
Route::middleware('auth:rdn')->get('/mealplansEdit/edit/{id}', [MealController::class, 'viewSubs2'])->name('meals.edit');


Route::middleware('auth:rdn')->put('/viewSubscription/edit/{id}', [LoginRegisterController::class, 'custPass'])->name('custpass');
//Route::middleware('auth:rdn')->get('/viewSubscription/edit/{id}', [LoginRegisterController::class, 'edit'])->name('editSubscription');


