<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Kategori extends Model
{
    use HasFactory, HybridRelations;

    protected $connection = 'mysql';
    protected $table = 'kategori';
    protected $fillable = ['nama_kategori', 'isFemale'];
    public $timestamps = false;

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}
