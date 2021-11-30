<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/item', function () {
    return view('pages.item-page');
});

Route::get('/cart', function () {
    return view('pages.cart');
})->name('cart');

Route::get('/transaction', function () {
    return view('pages.transaction');
})->name('transaction');

Route::get('/history_transaction', function () {
    return view('pages.historyTransaction');
})->name('historyTransaction');

Route::get('/wishlist', function () {
    return view('pages.wishlist');
})->name('wishlist');

Route::get('/category', function () {
    return view('pages.category');
})->name('category');