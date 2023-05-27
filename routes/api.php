<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BanStatusController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CommentGradeController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\SubscribeController;
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

/* Видео */
Route::get('/videos', [VideoController::class, 'index']);
Route::get('/videos/{hash_id}', [VideoController::class, 'find']);

/* Получение видео определенного пользователя */
Route::get('/@{nickname}/videos', [VideoController::class, 'getVideosByNickname']);

/* Комментарии к видео */
Route::get('/videos/{hash_id}/comments', [CommentController::class, 'allFromVideo']);

/* Подписчики */
Route::get('/@{nickname}/subscribers', [SubscribeController::class, 'getAllByNickname']);

/* Роуты с необходимой авторизацией */
Route::group(['middleware' => 'authorize'], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    /* Пользователь */
    Route::get('/user/me', [UserController::class, 'me']);
    Route::put('user/change/photo', [UserController::class, 'updatePhoto']);
    Route::put('user/change/banner', [UserController::class, 'updateBanner']);
    Route::put('user/change/nickname', [UserController::class, 'updateNickname']);

    /* Видео */
    Route::post('/videos', [VideoController::class, 'store']);
    Route::put('/videos/{hash_id}', [VideoController::class, 'update']);
    Route::delete('/videos/{hash_id}', [VideoController::class, 'delete']);


    /* Оценка видео */
    Route::post('/videos/{hash_id}/grade', [GradeController::class, 'grade']);
    Route::put('/videos/{hash_id}/grade', [GradeController::class, 'update']);
    Route::delete('/videos/{hash_id}/grade', [GradeController::class, 'delete']);


    /* Комментарии к видео */
    Route::post('/videos/{hash_id}/comments', [CommentController::class, 'store']);
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'delete']);

    /* Оценки комментариев */
    Route::post('/comments/{id}/grade', [CommentGradeController::class, 'store']);
    Route::put('/comments/{id}/grade', [CommentGradeController::class, 'update']);
    Route::delete('/comments/{id}/grade', [CommentGradeController::class, 'delete']);

    /* Подписчики */
    Route::post('/@{nickname}/subscribe', [SubscribeController::class, 'store']);
    Route::delete('/@{nickname}/subscribe', [SubscribeController::class, 'delete']);

    /* Роуты админа */
    Route::group(['middleware' => 'admin'], function () {
       Route::put('/videos/{hash_id}/ban', [VideoController::class, 'ban']);
       Route::put('/videos/{hash_id}/moderate', [VideoController::class, 'moderate']);
       Route::get('/ban_statuses', [BanStatusController::class, 'all']);
    });

});

