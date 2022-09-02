<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PictureController;
use GuzzleHttp\Middleware;
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


Route::post('register', [AuthController::class,'register']);
Route::get('pictures', [PictureController::class,'index']);
Route::get('pictures/search/{name}', [PictureController::class,'search']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('picture', [PictureController::class,'store']);
    Route::get('picture/{picture}', [PictureController::class,'show']);
    Route::put('picture/{picture}', [PictureController::class,'update']);
    Route::delete('picture/{id}', [PictureController::class,'destroy']);
});
