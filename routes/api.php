<?php

use App\Http\Controllers\Api\v1\AccessTokensController;
use App\Http\Controllers\Api\v1\ClassroomsController as V1ClassroomsController;
use App\Http\Controllers\Api\v1\ClassworksController;
use App\Http\Controllers\Api\V1\ClassroomMessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::prefix('v1')->group(function(){
    Route::middleware('auth:sanctum')->group(function(){
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::get('auth/access-tokens',[AccessTokensController::class,'index']);
        Route::delete('auth/access-tokens/{id?}',[AccessTokensController::class,'destroy']);

        Route::apiresource('/classrooms',V1ClassroomsController::class);
        Route::apiResource('classrooms.classworks',ClassworksController::class);
        Route::apiResource('classrooms.messages',   ClassroomMessagesController::class);


    });

    Route::middleware('guest:sanctum')->group(function(){
        Route::post('auth/access-tokens',[AccessTokensController::class,'store']);
    });

});



