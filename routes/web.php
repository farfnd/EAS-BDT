<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
})->name('home');

Route::get('/item', function () {
    return view('pages.item-page');
});

Route::get('/register', [UserController::class, 'show_register'])->name('register.show');

Route::post('/register', [UserController::class, 'create'])->name('register.create');

Route::get('/login', [UserController::class, 'show_login'])->name('login.show');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

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