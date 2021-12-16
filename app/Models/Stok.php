<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Stok extends Model
{
    use HasFactory, HybridRelations;

    protected $connection = 'mysql';
    protected $table = 'stok';
    // protected $primaryKey = ['barang_id', 'ukuran'];
    protected $fillable = ['barang_id', 'ukuran', 'jumlah'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
