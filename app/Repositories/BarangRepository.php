<?php

namespace App\Repositories;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Stok;
use App\Models\Ulasan;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class BarangRepository{
    protected $barang;
    
    public function __construct(Barang $barang)
    {
        $this->barang = $barang;
    }
    
    public function save($data){
        $barang = new $this->barang;
        
        $barang->nama = $data['nama'];
        $barang->deskripsi = $data['deskripsi'];
        $barang->harga = (int) str_replace(".", "", $data['harga']);
        $barang->kategori_id = (int) $data['kategori_id'];
        $barang->gender = (int) $data['gender'];
        
        $barang->foto = $data['foto']->getClientOriginalName();
        $data['foto']->storeAs('products', $barang->foto);
        $barang->save();

        foreach ($data['stok'] as $ukuran => $jumlah) {
            Stok::create([
                'barang_id' => $barang->id,
                'ukuran' => $ukuran,
                'jumlah' => (int) $jumlah
            ]);
        }

        return $barang->fresh();
    }

    public function getBarang($id){
        $barang = Barang::where('id', $id)->first();

        $barang->stok = $barang->stok()->get();
        $barang->inWishlist = $this->isBarangInUserWishlist($barang->id);
        return $barang;
    }

    public function getBarangRating($id){
        $ulasanAll = Barang::where('id', $id)->first()->ulasan()->get();

        if($ulasanAll->count()){
            $rateSum = 0;
            $rateCount = $ulasanAll->count();
            foreach ($ulasanAll as $ulasan) {
                $rateSum += $ulasan->rating;
            }

            return round($rateSum/$rateCount, 2);
        } else {
            return 0;
        }
    }

    public function getBarangStok($id){
        $stokAll = Barang::where('id', $id)->first()->stok()->get();

        if($stokAll->count()){

            $totalStok = 0;

            foreach ($stokAll as $stok) {
                $totalStok += $stok->jumlah;
            }

            return $totalStok;
        } else return 0;
    }

    public function getAllBarang(){
        $barangAll = Barang::all();

        foreach ($barangAll as $barang) {
            $barang->kategori = $barang->kategori()->first()->nama_kategori;
            $barang->rating = $this->getBarangRating($barang->id);
            $barang->stok = $this->getBarangStok($barang->id);
            $barang->inWishlist = $this->isBarangInUserWishlist($barang->id);
        }
        return $barangAll;
    }
    
    public function getLatestBarang($limit) {
        $barangAll = Barang::latest()->limit($limit)->get();

        foreach ($barangAll as $barang) {
            $barang->stok = $barang->stok()->get();
            $barang->inWishlist = $this->isBarangInUserWishlist($barang->id);
        }
        
        return $barangAll;
    }

    public function getAllBarangByGender($id) {
        $barangAll = Barang::where('gender', $id)->get();

        foreach ($barangAll as $barang) {
            $barang->stok = $barang->stok()->get();
            $barang->inWishlist = $this->isBarangInUserWishlist($barang->id);
        }
        
        return $barangAll;
    }

    public function getKategoriByGender($id) {
        return Kategori::where('isFemale', $id)->get();
    }

    public function putBarang($data){
        $data['harga'] = (int) str_replace(".", "", $data['harga']);
        $data['kategori_id'] = (int) $data['kategori_id'];
        $data['gender'] = (int) $data['gender'];
        
        $id = (int) $data['id'];
        $barang = $this->getBarang($id);

        if(isset($data['foto'])) {
            $data['foto']->storeAs('products', $data['foto']->getClientOriginalName());
            $data['foto'] = $data['foto']->getClientOriginalName();
        }
        
        foreach ($data['stok'] as $ukuran => $jumlah) {
            Stok::where([
                ['barang_id', $id], 
                ['ukuran', $ukuran],
                ])->update(['jumlah' => (int) $jumlah]);
        }

        unset($barang->stok);
        return $barang->update($data);
    }

    public function destroyBarang($id){
        Stok::where('barang_id', $id)->delete();
        Ulasan::where('barang_id', $id)->delete();
        return Barang::destroy($id);
    }

    public function postToWishlist($id)
    {
        return Wishlist::create([
            'barang_id' => $id,
            'user_id' => Auth::user()->id
        ]);
    }

    public function destroyFromWishlist($id)
    {
        return Wishlist::where([
            ['barang_id', $id],
            ['user_id', Auth::user()->id]
        ])->delete();
    }

    public function getAllWishlist()
    {
        $wishlistAll = Auth::user()->wishlist;
        foreach ($wishlistAll as $wishlist) {
            $wishlist->barang->rating = $this->getBarangRating($wishlist->barang->id);
        }

        return $wishlistAll;
    }

    public function isBarangInUserWishlist($id)
    {
        $barangSearch = Barang::find($id);
        $wishlistAll = Auth::user()->wishlist;
        foreach ($wishlistAll as $wishlist) {
            if ($wishlist->barang->is($barangSearch)){
                return true;
                break;
            }
        }

        return false;
    }
}

?>