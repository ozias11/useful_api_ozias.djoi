<?php

use App\Http\Controllers\ModulesController;
use App\Http\Controllers\UrlShortnerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckModuleActive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(UserController::class)->group(function(){
    Route::post('/register','register');
    Route::post('/login','connexion');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::controller(ModulesController::class)->group(function(){
        Route::get('/modules','index');
        Route::post('/modules/{id}/activate','activatemodule');
        Route::post('/modules/{id}/deactivate','desactivemodule');
    }); 
});

Route::middleware('auth:sanctum')->group(function(){
    Route::middleware(CheckModuleActive::class.':1')->group(function(){
        Route::controller(UrlShortnerController::class)->group(function(){
            Route::post('/shorten','creatshortlink');
        });
    });
    
});