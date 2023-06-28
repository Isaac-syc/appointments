<?php

use Illuminate\Support\Facades\Route;
use Src\Agenda\Business\Presentation\HTTP\BusinessController;

Route::group([
    'prefix' => 'business'
], function () {
    Route::post('', [BusinessController::class, 'store']);

});
