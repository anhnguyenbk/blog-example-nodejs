<?php

use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\UserApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Users
Route::get('/users', [UserApiController::class, 'list']);
Route::get('/users/statuses', [UserApiController::class, 'getStatuses']);
Route::get('/user/{id}', [UserApiController::class, 'get']);
Route::put('/user/{id}', [UserApiController::class, 'update']);

// Posts
Route::get('/posts', [PostApiController::class, 'list']);
Route::get('/post/{id}', [PostApiController::class, 'get']);
Route::delete('/post/{id}', [PostApiController::class, 'delete']);

// Categories
Route::get('/categories', [CategoryApiController::class, 'list']);
Route::get('/categories-hierarchy', [CategoryApiController::class, 'listHierarchy']);
Route::post('/categories', [CategoryApiController::class, 'create']);
Route::put('/category/{id}', [CategoryApiController::class, 'update']);
Route::delete('/category/{id}', [CategoryApiController::class, 'delete']);
Route::post('/categories/order', [CategoryApiController::class, 'order']);

