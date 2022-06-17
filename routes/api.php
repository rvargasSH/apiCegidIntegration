<?php

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


Route::post('create-customer', [App\Http\Controllers\CustomController::class, 'createCustomer']);
Route::post('update-customer', [App\Http\Controllers\CustomController::class, 'updateCustomer']);
Route::post('create-order', [App\Http\Controllers\OrderController::class, 'createOrder']);
Route::get('get-order-status/{orderId}', [App\Http\Controllers\OrderController::class, 'getOrderStatus']);
Route::get('get-sells-by-store/{storeId}', [App\Http\Controllers\SellsController::class, 'getSellsByStore']);
Route::get('get-inventory-by-store-product/{storeId}/{productCode}', [App\Http\Controllers\InventoryController::class, 'getInventoryByStoreAndProductCode']);