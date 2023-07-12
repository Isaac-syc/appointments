<?php

use Illuminate\Support\Facades\Route;
use Src\Agenda\Business\Presentation\HTTP\BusinessController;

Route::group([
    'prefix' => 'business'
], function () {
    Route::get('/', [BusinessController::class, 'all']);
    Route::post('/', [BusinessController::class, 'store']);
    Route::post('/{id}', [BusinessController::class, 'update']);
    Route::get('/{id}', [BusinessController::class, 'getById']);

});
