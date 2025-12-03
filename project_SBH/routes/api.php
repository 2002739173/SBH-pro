<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BakeryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});


//---------------------------Bakery_owner----------------------------------------------
Route::middleware(['auth:sanctum', 'bakery.owner'])->prefix('dashboard')->group(function () {
    
 
    Route::post('/bakery', [BakeryController::class, 'createBakery']);
    Route::put('/bakery', [BakeryController::class, 'updateBakery']);
    Route::delete('/bakery', [BakeryController::class, 'deleteBakery']);
    Route::post('/products', [BakeryController::class, 'addProduct']);
    Route::put('/products/{product}', [BakeryController::class, 'updateProduct']);
    Route::delete('/products/{product}', [BakeryController::class, 'deleteProduct']);
});

//------------------------------Admin--------------------------------------------
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::post('/register-bakery-owner', [AuthController::class, 'registerBakeryOwner']);
});

