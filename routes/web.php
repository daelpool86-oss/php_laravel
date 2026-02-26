<?php

use App\Http\Controllers\UserContrller;
use App\Http\Controllers\CardContrller;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
/// out methods
Route::post("/login", [UserContrller::class, "login"])->name("loginuser");
Route::post("/register", [UserContrller::class, "register"])->name("registeruser");

///////////////////////////////////////////////////////////////

// out views
Route::get("/login", function () {
    return view("login"); })->name("login");
Route::get("/register", function () {
    return view("register"); })->name("register");



//  middleware
Route::middleware('auth')->group(function () {
    //in methods
    Route::post('/user', [UserContrller::class, "store"])->name("user-create");
    Route::delete("/user-delete", [UserContrller::class, "destroy"])->name("user-delete");
    Route::put("/user-update", [UserContrller::class, "update"])->name("user-update");
    Route::get("/user-profile", [UserContrller::class, "index"])->name("user-profile");
    Route::put("/update", [UserContrller::class, "doupdate"])->name("updateUser");
    Route::post("/createcard", [CardContrller::class, "create"])->name("addnewcardmange");
    Route::post("/create-course", [CourseController::class, "store"])->name("create-course");
    Route::put("/update-course/{id}", [CourseController::class, "update"])->name("update-course");
    Route::delete("/delete-course/{id}", [CourseController::class, "destroy"])->name("delete-course");

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////

    // in views
    Route::get('/', function () {
        return view('home'); })->name("home");
    Route::get('/update-profile', function () {
        return view('update-profile'); })->name("update-profile");
    Route::get('/AddNewCard', function () {
        return view('newCard'); })->name("AddNewCard");
    Route::get("/course-mange", [CourseController::class, "index"])->name("course-mange");


});
