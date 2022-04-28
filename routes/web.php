<?php

use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;

// Route::middleware('auth')->group(function(){
    // Princípal
    Route::get('/', [MainController::class, 'home'])->name('home');
    Route::get('get_edit_arranchamento/{id}' ,[MainController::class, 'get_edit_arranchamento']);
    Route::get('/arranchamento/delete/{id}' ,[MainController::class, 'get_delete_arranchamento']);
    Route::get('get_cogitative_day' ,[MainController::class, 'get_cogitative_day']);


    //POSTs
    Route::post('get_arranchamentos',[MainController::class, 'get_arranchamentos']);
    Route::post('new_arranchamento', [MainController::class, 'new_arranchamento']);
    Route::post('edit_arranchamento', [MainController::class, 'edit_arranchamento']);
    Route::post('get_cogitative' ,[MainController::class, 'get_cogitative']);


    //Cardápio
    Route::get('menu',[MenuController::class, 'menu'])->name('menu');
    Route::get('menu_day',[MenuController::class, 'menu_day']);
    //POSTs
    Route::post('get_menu',[MenuController::class, 'get_menu'])->name('get_menu');
    Route::post('new_menu',[MenuController::class, 'new_menu'])->name('new_menu');



    //Histórico
    Route::get('history',[HistoryController::class, 'history'])->name('history');

    // });
