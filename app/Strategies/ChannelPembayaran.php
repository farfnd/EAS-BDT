<?php

namespace App\Strategies;

use Illuminate\Http\Request;

interface ChannelPembayaran
{
    public function post_pembayaran(Request $request);
    public function show_payment(string $id);
    public function show_checkout(Request $request);
}
