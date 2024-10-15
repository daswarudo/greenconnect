<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/rdnDashboard', function () {
    return view('rdnDashboard');
})->name('rdnDashboard');