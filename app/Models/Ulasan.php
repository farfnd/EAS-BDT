<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Ulasan extends Model
{
    
    protected $connection = 'mongodb';
    protected $collection = 'ulasan';
    protected $fillable = ['barang_id', 'user_id', 'ulasan', 'rating', 'file_ulasan', 'created_at'];
    public $timestamps = ["created_at"]; //only want to used created_at column
    const UPDATED_AT = null; //and updated by default null set

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
