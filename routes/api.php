<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function(){ //controle de versões

    Route::post('login',[AuthController::class, 'login']); 
});

