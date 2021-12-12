<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
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
    START ::: UNAUTHENTICATED USER FEATURES ROUTING
======================================================================== */

Route::get('/', [BarangController::class, 'index'])->name('home');

Route::get('/item/{id}', [BarangController::class, 'show'])->name('barang.show');

Route::get('/category/{id}', [BarangController::class, 'show_category'])->name('category');

Route::get('/register', [UserController::class, 'show_register'])->name('register.show');
Route::post('/register', [UserController::class, 'create'])->name('register.create');

Route::get('/login', [UserController::class, 'show_login'])->name('login.show');
Route::post('/login', [UserController::class, 'login'])->name('login');

/* ========================================================================
        END ::: UNAUTHENTICATED USER FEATURES ROUTING
======================================================================== */

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/getAuthInfo', [UserController::class, 'getAuthInfo']);

    /* ========================================================================
        START ::: CART, WISHLIST, TRANSACTION ROUTING
    ======================================================================== */

    /* ======== CART SECTION ======== */
    Route::get('/cart', [HomeController::class, 'show_cart'])->name('cart');

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
    Route::get('/wishlist', [BarangController::class, 'show_wishlist'])->name('wishlist');

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

    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/admin', function () {
            return redirect(route('admin.barang'));
        });

        Route::get('/admin/barang', [BarangController::class, 'index_admin'])->name('admin.barang');
        
        Route::post('/admin/barang', [BarangController::class, 'create'])->name('admin.barang.create');
        Route::put('/admin/barang', [BarangController::class, 'update'])->name('admin.barang.edit');
    });

    /* ========================================================================
        END ::: ADMIN ROUTING
    ======================================================================== */
});

Route::get('/product_images/{filename}', [HomeController::class, 'getProductImage'])->name('show_product_image');
Route::get('/review_images/{filename}', [HomeController::class, 'getReviewImage'])->name('show_review_image');