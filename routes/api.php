<?php

use App\Http\Controllers\Api\AnswerController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('logout',[UserController::class,'logout'])->middleware('auth:sanctum');

Route::get('questions',[QuestionController::class,'index'])->middleware(['auth:sanctum']);

Route::get('doctors',[DoctorController::class,'index']);

Route::post('patients/doctors',[DoctorController::class,'attachment'])->middleware(['auth:sanctum']);

Route::post('questions/answers',[AnswerController::class,'store'])->middleware(['auth:sanctum']);

Route::post('patients/messages',[MessageController::class,'store'])->middleware(['auth:sanctum']);
Route::get('patients/messages',[MessageController::class,'index'])->middleware(['auth:sanctum']);

Route::post('patients/status',[StatusController::class,'store'])->middleware(['auth:sanctum']);
// Route::get('doctors/patients',[DoctorController::class,'index'])->middleware(['auth:sanctum']);