<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Homepage;
use App\Http\Controllers\UserContrller;            

Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/home', [Homepage::class, 'index']);

    });


    Route::post("/login", [UserContrller::class, "login"])->name("login");
