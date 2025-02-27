<?php

use App\Http\Controllers\MachinesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');

Route::get('/user', function (Request $request) {
    return $request->user();
})
->middleware('auth:sanctum');

Route::get('/user/logout', [AuthController::class, 'logout'])
    ->name('auth.logout');

Route::prefix('machines')->controller(MachinesController::class)
    ->group(function () {
        Route::get('/', 'index')->name('machine.index');
        Route::get('{id}', 'show')->name('machine.show');
        Route::post('/', 'store')->name('machine.create');
        Route::put('{id}', 'update')->name('machine.update');
        Route::delete('{id}', 'destroy')->name('machine.delete');
    })->middleware([
        'auth:sanctum'
    ]);






