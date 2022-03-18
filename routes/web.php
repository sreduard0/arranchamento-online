<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

// Route::middleware('auth')->group(function(){
    // Main
    Route::get('/', [MainController::class, 'home'])->name('home');

    // });
