<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

//redirect all routes to the app to handle routing
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
