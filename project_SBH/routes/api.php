<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BakeryController;

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
Route::get('/bakeries', [BakeryController::class, 'index']); // عرض وفلترة المخابز
Route::get('/bakeries/{bakery}/products', [BakeryController::class, 'showProducts']); // عرض منتجات مخبز معين

// مسارات تتطلب مصادقة (لتسجيل الخروج، أو أي وظيفة محمية أخرى)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/orders', [OrderController::class, 'store']); // لإنشاء طلب جديد
    Route::get('/orders', [OrderController::class, 'index']); // لعرض الطلبات (واجهة My Orders)
    Route::put('/orders/{order}/cancel', [OrderController::class, 'cancel']); // لإلغاء الطلب

   
});
