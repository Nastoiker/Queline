<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VideoController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/* Категории */
Route::get('/categories', [CategoryController::class, 'index']);


Route::group(['middleware' => 'authorize'], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    /* Пользователь */
    Route::get('/user/me', [UserController::class, 'me']);

    /* Видео */
    Route::get('/videos', [VideoController::class, 'index']);
    Route::get('/videos/{hash_id}', [VideoController::class, 'find']);
    Route::post('/videos', [VideoController::class, 'store']);
    Route::put('/videos/{hash_id}', [VideoController::class, 'update']);

    /* Получение видео определенного пользователя */
    Route::get('/@{nickname}/videos', [VideoController::class, 'getVideosByNickname']);
});

