<?php

namespace App\Repositories;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use App\Models\Stok;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiRepository{
    protected $barang;
    protected $keranjang;
    protected $pembayaran;
    
    public function __construct(Barang $barang, Keranjang $keranjang, Pembayaran $pembayaran)
    {
        $this->barang = $barang;
        $this->keranjang = $keranjang;
        $this->pembayaran = $pembayaran;
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

    public function getAllBanks()
    {
        return DB::table('banks')->get();
    }

    public function updateBuktiTransaksi($data)
    {
        $data['bukti']->storeAs('transaction', $data['bukti']->getClientOriginalName());
        $data['bukti'] = $data['bukti']->getClientOriginalName();

        $id = $data['id'];
        // return var_dump(Pembayaran::find($id));
        return Pembayaran::find($id)->update(
            ["nama_pemilik_rekening" => $data['nama_pemilik_rekening']],
            ["nama_bank" => $data['nama_bank']],
            ["no_rekening" => $data['no_rekening']],
            ["bukti" => $data['bukti']],
        );
    }
}

?>