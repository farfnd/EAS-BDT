<?php

namespace App\Repositories;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Stok;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;

class TransaksiRepository{
    // protected $barang;
    
    public function __construct(Barang $barang, Keranjang $keranjang)
    {
        $this->barang = $barang;
        $this->keranjang = $keranjang;
    }
    
    public function postKeranjang($id)
    {
        $keranjang = new $this->keranjang;
        
        $keranjang->barang_id = $id;
        $keranjang->user_id = Auth::user()->id;
        $keranjang->jumlah = 1;
        $keranjang->save();

        return $keranjang->fresh;
    }

    public function destroyKeranjang($id)
    {
        return Keranjang::where([
            ['barang_id','=', $id],
            ['user_id','=', Auth::user()->id],
        ])->delete();
    }

    public function updateKeranjang($id, $count)
    {
        // var_dump($count);
        return Keranjang::where([
            ['barang_id','=', $id],
            ['user_id','=', Auth::user()->id],
        ])->update(["jumlah" => (int) $count]);
    }
}

?>