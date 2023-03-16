<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\AssignmentApiController;
use App\Http\Controllers\Api\SubmissionApiController;

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

Route::prefix('v1')->group(function () {

    Route::post('/register', [AuthApiController::class, 'register'])->name('api.user.register');

    Route::post('/login', [AuthApiController::class, 'login'])->name('api.user.login');

    Route::middleware('auth:sanctum')->group( function () {

        //Assignment
        Route::get('/assignment', [AssignmentApiController::class, 'index'])->name('api.assignment.list');

        Route::post('/assignment/create', [AssignmentApiController::class, 'store'])->name('api.assignment.create');

        Route::put('/assignment/{id}/update', [AssignmentApiController::class, 'update'])->name('api.assignment.update');

        Route::post('/assignment/delete', [AssignmentApiController::class, 'destroy'])->name('api.assignment.delete');

        Route::post('/assignment/assign', [AssignmentApiController::class, 'assign'])->name('api.assignment.assign');

        Route::get('/student/assignment', [AssignmentApiController::class, 'studentAssignment'])->name('api.student.assignment.list');

        //Submission
        Route::post('/assignment/submission', [SubmissionApiController::class, 'store'])->name('api.assignment.submission');

        Route::get('/submission', [SubmissionApiController::class, 'index'])->name('api.submission.list');

        Route::get('/submission/student', [SubmissionApiController::class, 'listByStudent'])->name('api.submission.list.by.student');

   });

});
