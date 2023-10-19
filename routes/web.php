<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, "index"])->name("home");

Route::resource("drinks", DrinksController::class);