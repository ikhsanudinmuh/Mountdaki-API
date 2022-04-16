<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ClimbingRegistrationController;
use App\Http\Controllers\API\MountainController;
use App\Http\Controllers\API\RatingController;
use App\Http\Controllers\API\UserController;
use App\Models\ClimbingRegistration;
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

#auth routes
Route::post('login', [AuthController::class, 'loginUser']);
Route::post('admin/login', [AuthController::class, 'loginAdmin']);

#user routes
Route::post('users', [UserController::class, 'store']);
Route::get('users/{id}', [UserController::class, 'show'])->middleware(['auth:sanctum', 'ability:user,admin']);
Route::get('users', [UserController::class, 'index'])->middleware(['auth:sanctum', 'ability:admin']);

#mountain routes
Route::get('mountains', [MountainController::class, 'index']);
Route::get('mountains/{id}', [MountainController::class, 'show']);
Route::put('mountains/{id}', [MountainController::class, 'update'])->middleware(['auth:sanctum', 'ability:admin']);
Route::get('mountains/search/{name}', [MountainController::class, 'search']);
Route::post('mountains', [MountainController::class, 'store'])->middleware(['auth:sanctum', 'ability:admin']);

#climbing registration routes
Route::get('climbing_registrations', [ClimbingRegistrationController::class, 'index']);
Route::post('climbing_registrations', [ClimbingRegistrationController::class, 'store'])->middleware(['auth:sanctum', 'ability:user']);
Route::get('climbing_registrations/{id}', [ClimbingRegistrationController::class, 'show'])->middleware(['auth:sanctum', 'ability:user,admin']);
Route::put('climbing_registrations/approve/{id}', [ClimbingRegistrationController::class, 'approve'])->middleware(['auth:sanctum', 'ability:admin']);
Route::put('climbing_registrations/decline/{id}', [ClimbingRegistrationController::class, 'approve'])->middleware(['auth:sanctum', 'ability:admin']);
Route::put('climbing_registrations/climb/{id}', [ClimbingRegistrationController::class, 'climb'])->middleware(['auth:sanctum', 'ability:user']);
Route::put('climbing_registrations/done/{id}', [ClimbingRegistrationController::class, 'done'])->middleware(['auth:sanctum', 'ability:user']);

//rating routes
Route::post('ratings', [RatingController::class, 'store'])->middleware(['auth:sanctum', 'ability:user']);