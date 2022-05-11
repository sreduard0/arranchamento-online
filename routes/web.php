<?php

use App\Http\Controllers\CogitativeController;
use App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MenuController;

Route::middleware('auth')->group(function(){
    Route::get('/', [MainController::class, 'home'])->name('home');//Tela inicial dos usuarios
    Route::get('menu',[MenuController::class, 'menu'])->name('menu');//View do cardapio
    Route::get('get_edit_arranchamento/{id}' ,[MainController::class, 'get_edit_arranchamento']); //Busca info para preencher model
    Route::get('/arranchamento/delete/{id}' ,[MainController::class, 'get_delete_arranchamento']);//Deleta arranchamento
    Route::get('menu_day',[MenuController::class, 'menu_day']);//Busca o cardapio do dia
    Route::post('get_menu',[MenuController::class, 'get_menu'])->name('get_menu');//Busca os cardapios

    //POSTs
    Route::post('new_arranchamento', [MainController::class, 'new_arranchamento']);//envia dados do militar para arranchar
    Route::post('edit_arranchamento', [MainController::class, 'edit_arranchamento']);//Envia dados atualizados do arranchamento



    Route::middleware('CheckIsAdm')->group(function(){
        Route::get('get_edit_menu/{id}',[MenuController::class, 'get_edit_menu']);//Busca informaçoes do menu
        Route::get('menu/delete/{id}',[MenuController::class, 'delete_menu']);//Deleta o cardapio
        Route::get('get_cogitative_day' ,[CogitativeController::class, 'get_cogitative_day']);//Busca quantitativo do dia
        Route::get('cogitative/{company}',[CogitativeController::class, 'cogitative_company'])->name('cogitative_company');//Quantitativo da companhia
        Route::post('get_cogitative_company' ,[CogitativeController::class, 'get_company_cogitative'])->name('get_cogitative_company');//Busca quantitativa da companhia

        Route::post('get_cogitative' ,[MainController::class, 'get_cogitative']);
        Route::post('new_menu',[MenuController::class, 'new_menu']);//Envia dados do novo cardapio
        Route::post('edit_menu',[MenuController::class, 'edit_menu']);//Envia dados atualizados do cardapio



    });
    Route::middleware('CheckIsFurriel')->group(function(){
        Route::post('arranchamento_cia', [MainController::class, 'arranchamento_cia'])->name('arranchamento_cia');//Arranchar companhia
        Route::post('get_company_cogitative' ,[CogitativeController::class, 'get_company_cogitative'])->name('get_company_cogitative');//Busca quantitativa da companhia
    });
    Route::middleware('CheckIsConv')->group(function(){
        Route::get('history',[HistoryController::class, 'history'])->name('history');//View historico do usuario
        Route::post('get_history' ,[HistoryController::class, 'get_history'])->name('get_history');//Busca historico do usuario
        Route::post('get_arranchamentos',[MainController::class, 'get_arranchamentos']);//Busta tabela de arranchados

    });
});
