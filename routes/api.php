<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /* ======== ADMIN API ======== */
    Route::get('/admin/getKategori/{id}', [BarangController::class, 'getKategori']); 
    Route::get('/admin/getBarang/{id}', [BarangController::class, 'getBarang']); 
    Route::delete('/admin/barang/{id}', [BarangController::class, 'delete']);
    
    /* ======== TRANSAKSI API ======== */
    Route::post('/addToCart/{id}', [TransaksiController::class, 'addToCart']);
    Route::delete('/deleteFromCart/{id}', [TransaksiController::class, 'deleteFromCart']);
    Route::put('/updateCart/{id}', [TransaksiController::class, 'editCart']);

    Route::put('/editBuktiTransfer', [TransaksiController::class, 'editBuktiTransfer']);
    Route::get('/admin/getTransaksi/{id}', [TransaksiController::class, 'getTransaksi']);
    
    /* ======== WISHLIST API ======== */
    Route::post('/addToWishlist/{id}', [BarangController::class, 'addToWishlist']);
    Route::post('/deleteFromWishlist/{id}', [BarangController::class, 'deleteFromWishlist']);

    /* ======== BARANG API ======== */
    Route::post('/postUlasan', [BarangController::class, 'postUlasan']);
});