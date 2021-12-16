<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Barang extends Model
{
    use HasFactory, SoftDeletes, HybridRelations;

    protected $connection = 'mysql';
    protected $table = 'barang';
    protected $fillable = ['nama', 'rating', 'deskripsi', 'harga', 'foto', 'gender', 'kategori_id', 'warna', 'ukuran'];

    public function stok()
    {
        return $this->hasMany(Stok::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }
}
