<?php

use App\Http\Controllers\CogitativeController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;

// Route::middleware('auth')->group(function(){
    // Princípal
    Route::get('/', [MainController::class, 'home'])->name('home');
    Route::get('get_edit_arranchamento/{id}' ,[MainController::class, 'get_edit_arranchamento']);
    Route::get('/arranchamento/delete/{id}' ,[MainController::class, 'get_delete_arranchamento']);
    Route::get('/arranchar_cia' ,[MainController::class, 'arranchar_cia']);


    //POSTs
    Route::post('get_arranchamentos',[MainController::class, 'get_arranchamentos']);
    Route::post('new_arranchamento', [MainController::class, 'new_arranchamento']);
    Route::post('edit_arranchamento', [MainController::class, 'edit_arranchamento']);



    //Cardápio
    Route::get('menu',[MenuController::class, 'menu'])->name('menu');
    Route::get('menu_day',[MenuController::class, 'menu_day']);
    Route::get('get_edit_menu/{id}',[MenuController::class, 'get_edit_menu']);
    Route::get('menu/delete/{id}',[MenuController::class, 'delete_menu']);

    //POSTs
    Route::post('get_menu',[MenuController::class, 'get_menu'])->name('get_menu');
    Route::post('new_menu',[MenuController::class, 'new_menu']);
    Route::post('edit_menu',[MenuController::class, 'edit_menu']);


    //Histórico
    Route::get('history',[HistoryController::class, 'history'])->name('history');
    //POSTs
    Route::post('get_history' ,[HistoryController::class, 'get_history'])->name('get_history');



    //COGITATIVOS
    Route::get('cogitative/{company}',[CogitativeController::class, 'cogitative_company'])->name('cogitative_company');
    Route::get('get_cogitative_day' ,[CogitativeController::class, 'get_cogitative_day']);

    //POSTs
    Route::post('get_cogitative' ,[MainController::class, 'get_cogitative']);
    Route::post('get_company_cogitative' ,[CogitativeController::class, 'get_company_cogitative'])->name('get_company_cogitative');


    // });
