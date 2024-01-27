<?php

use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegistrationController;
use App\Http\Controllers\API\URLController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/shorten-url', [URLController::class, 'shortUrl']);
    Route::get('/user-urls', [URLController::class, 'getUserURLs']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/user/registration', [RegistrationController::class, 'register']);
Route::post('/user/login', [LoginController::class, 'login']);