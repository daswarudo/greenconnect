<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');//change to login to view login, welcome=dashboard
});

Route::get('/login', function () {
    return view('login');
})->name('login');