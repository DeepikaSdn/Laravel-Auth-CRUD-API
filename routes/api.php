<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

    Route::get('public/login', [App\Http\Controllers\API\APIController::class, 'login']);
    Route::group(['middleware' => 'auth:customer'], function (){

        Route::post('products',[App\Http\Controllers\API\APIController::class, 'products']);
 
    });

