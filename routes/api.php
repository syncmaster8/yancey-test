<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\LoginController;
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
Route::post('login', [LoginController::class, 'login']);

Route::group(['middleware' =>["auth:api"]], function(){
    
    Route::post('logout', [LoginController::class, 'logout']);

    Route::prefix('user')->group(function(){
        Route::get('get', [AdminController::class, 'read']);
        Route::post('new', [AdminController::class, 'create']);
        Route::post('{user_id}/update', [AdminController::class, 'update']);
        Route::post('{user_id}/delete', [AdminController::class, 'delete']);
    });
    
    Route::get('visitors/get', [VisitorController::class, 'read']);
    
    Route::get('store/{store_id}/get', [StoreController::class, 'read']);

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

