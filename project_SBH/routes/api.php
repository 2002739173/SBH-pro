<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BakeryController;
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AdminController;
=======
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60

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
<<<<<<< HEAD

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

=======
Route::get('/bakeries', [BakeryController::class, 'index']); // عرض وفلترة المخابز
Route::get('/bakeries/{bakery}/products', [BakeryController::class, 'showProducts']); // عرض منتجات مخبز معين

// مسارات تتطلب مصادقة (لتسجيل الخروج، أو أي وظيفة محمية أخرى)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/orders', [OrderController::class, 'store']); // لإنشاء طلب جديد
    Route::get('/orders', [OrderController::class, 'index']); // لعرض الطلبات (واجهة My Orders)
    Route::put('/orders/{order}/cancel', [OrderController::class, 'cancel']); // لإلغاء الطلب

   
});
>>>>>>> 051ecec328ba2554ab488449953a539178d14f60
