<?php

use App\Http\Controllers\UserContrller;
use Illuminate\Support\Facades\Route;

Route::post("/login-user", [UserContrller::class, "login"])->name("loginuser");
Route::get("/login", function () {
    return view("login");
})->name("login");

Route::get("/register", function () {
    return view("register");
})->name("register");
Route::post("/register", [UserContrller::class, "register"])->name("registeruser");


Route::get('/', function () {
    return view('welcome'); })->name("welcome");


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
