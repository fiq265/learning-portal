<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\UserApiController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthApiController::class, 'register'])->name('api.user.register');

    Route::post('/login', [AuthApiController::class, 'login'])->name('api.user.login');

    Route::middleware('auth:sanctum')->group( function () {

        Route::get('/user', [UserApiController::class, 'index'])->name('api.user.list');

        Route::get('/user/create', [UserApiController::class, 'create'])->name('api.user.create');

        Route::put('/user/update', [UserApiController::class, 'update'])->name('api.user.update');

        Route::post('/user/delete', [UserApiController::class, 'destroy'])->name('api.user.delete');

   });

});
