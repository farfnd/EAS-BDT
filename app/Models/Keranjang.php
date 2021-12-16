<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Keranjang extends Model
{
    
    protected $connection = 'mongodb';
    protected $collection = 'keranjang';
    protected $fillable = ['barang_id', 'user_id', 'jumlah'];
    public $timestamps = false;

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
