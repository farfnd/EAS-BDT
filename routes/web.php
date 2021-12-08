<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

/* ========================================================================
    START ::: PAGE VIEWS
======================================================================== */

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/item', function () {
    return view('pages.item-page');
});

Route::get('/category', function () {
    return view('pages.category');
})->name('category');

/* ========================================================================
    END ::: PAGE VIEWS
======================================================================== */

/* ========================================================================
    START ::: USER ROUTING
======================================================================== */

Route::get('/register', [UserController::class, 'show_register'])->name('register.show');
Route::post('/register', [UserController::class, 'create'])->name('register.create');

Route::get('/login', [UserController::class, 'show_login'])->name('login.show');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

/* ========================================================================
    END ::: USER ROUTING
======================================================================== */

/* ========================================================================
    START ::: CART, WISHLIST, TRANSACTION ROUTING
======================================================================== */

/* ======== CART SECTION ======== */
Route::get('/cart', function () {
    return view('pages.cart');
})->name('cart');

/* ======== CHECKOUT SECTION ======== */
Route::get('/checkout', function () {
    if(Auth::check()) {
        return view('pages.checkout');
    }
    return redirect("/");
})->name('checkout');

/* ======== PAYMENTS SECTION ======== */
Route::get('/bank-payment', function () {
    if(Auth::check()) {
        return view('pages.payments.bank');
    }
    return redirect("/");
})->name('bank-payment');
Route::get('/va-payment', function () {
    if(Auth::check()) {
        return view('pages.payments.virtual-account');
    }
    return redirect("/");
})->name('va-payment');
Route::get('/payment-detail', function () {
    if(Auth::check()) {
        return view('pages.payments.details');
    }
    return redirect("/");
})->name('payment-detail');
Route::get('/payment-invoice', function () {
    if(Auth::check()) {
        return view('pages.payments.invoice');
    }
    return redirect("/");
})->name('payment-invoice');

/* ======== WISHLIST SECTION ======== */
Route::get('/wishlist', function () {
    return view('pages.wishlist');
})->name('wishlist');

/* ======== TRANSACTION SECTION ======== */
Route::get('/transaction', function () {
    return view('pages.transaction');
})->name('transaction');

Route::get('/history_transaction', function () {
    return view('pages.historyTransaction');
})->name('historyTransaction');

/* ========================================================================
    END ::: CART, WISHLIST, TRANSACTION ROUTING
======================================================================== */

/* ========================================================================
    START ::: ADMIN ROUTING
======================================================================== */

Route::get('/admin', function () {
    return view('pages.admin.barang');
})->name('admin');


/* ========================================================================
    END ::: ADMIN ROUTING
======================================================================== */