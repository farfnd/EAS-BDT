<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $table = 'ulasan';
    protected $fillable = ['barang_id', 'user_id', 'ulasan', 'rating', 'file_ulasan', 'created_at'];
    public $timestamps = ["created_at"]; //only want to used created_at column
    const UPDATED_AT = null; //and updated by default null set

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
