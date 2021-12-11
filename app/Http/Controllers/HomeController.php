<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        # code...
    }
    
    public function getProductImage($filename) {
        return response()->file(storage_path('app/products/' . $filename));
    }

    public function getReviewImage($filename) {
        return response()->file(storage_path('app/reviews/' . $filename));
    }

    public function show_cart () {
        return view('pages.cart');
    }
}
