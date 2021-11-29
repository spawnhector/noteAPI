<?php

use App\Http\Controllers\noteController;
use App\Http\Controllers\userController;
use App\Models\note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'note'], function() {
        Route::get('/', [noteController::class,'notes']);
        Route::post('/create', [noteController::class,'create']);
        Route::post('/update', [noteController::class,'update']);
        Route::delete('/delete/{id}', [noteController::class,'delete']);
    });
});


Route::post('/register', [userController::class,'register']);
Route::post('/login', [userController::class,'login']);