<?php

use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;

// Route::middleware('auth')->group(function(){
    // Princípal
    Route::get('/', [MainController::class, 'home'])->name('home');
    //POSTs
    Route::post('get_arranchamentos',[MainController::class, 'get_arranchamentos']);
    Route::post('new_arranchamento', [MainController::class, 'new_arranchamento']);


    //Cardápio
    Route::get('menu',[MenuController::class, 'menu'])->name('menu');

    //Histórico
    Route::get('history',[HistoryController::class, 'history'])->name('history');

    // });
