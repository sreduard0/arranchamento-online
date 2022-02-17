<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\EnterpriseController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\VisitorsController;
use App\Models\EnterpriseModel;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth')->group(function(){
    // Records
        Route::get('/', [RecordsController::class, 'records'])->name('home');

//   });
