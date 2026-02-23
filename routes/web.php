<?php

use App\Http\Controllers\UserContrller;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name("welcome");
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name("home");

    Route::post('/user', [UserContrller::class, "store"])->name("user-create");
    Route::get("/user-profile", [UserContrller::class, "index"])->name("user-profile");

    Route::delete("/user-delete", [UserContrller::class, "destroy"])->name("user-delete");

    Route::put("/user-update", [UserContrller::class, "update"])->name("user-update");

    Route::get('/update-profile', function () {
        return view('update-profile');
    })->name("update-profile");

    Route::put("/update", [UserContrller::class, "doupdate"])->name("updateUser");

    });
