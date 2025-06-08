<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Models\Project;
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
Route::apiResource('products', ProductController::class);



// Contact form submission route
Route::post('/contact', [ContactController::class, 'store']);
// API маршруты для новостей
Route::apiResource('news', NewsController::class);

Route::middleware('auth:sanctum')->group(function () {
    // Роли
    Route::apiResource('roles', RoleController::class);

    // Права
    Route::apiResource('permissions', PermissionController::class);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
