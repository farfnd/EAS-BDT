<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranDetail extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_detail';
    protected $guarded = [];
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
