<?php

use Illuminate\Support\Facades\Route;
use Src\Agenda\Services\Presentation\HTTP\ServiceController;

Route::group([
    'prefix' => 'service'
], function () {
    // Route::get('/', [ServiceController::class, 'all']);
    Route::post('/', [ServiceController::class, 'store']);

});
