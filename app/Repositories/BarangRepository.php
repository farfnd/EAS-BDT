<?php

namespace App\Repositories;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Stok;

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

    public function getAllBarang(){
        $barangAll = Barang::all();

        foreach ($barangAll as $barang) {
            $barang->kategori = $barang->kategori()->first()->nama_kategori;
            $ulasanAll = $barang->ulasan()->get();
            
            if($ulasanAll->count()){
                $rateSum = 0;
                $rateCount = 0;
                foreach ($ulasanAll as $ulasan) {
                    $rateSum += $ulasan->rating;
                    $rateCount++;
                }
                $barang->rating = round($rateSum/$rateCount, 2);
            } else {
                $barang->rating = 'N/A';
            }
            
            $stokAll = $barang->stok()->get();
            $totalStok = 0;
            foreach ($stokAll as $stok) {
                $totalStok += $stok->jumlah;
            }
            $barang->stok = $totalStok;
        }
        return $barangAll;
    }
    
    public function getBarang($id){
        $barang = Barang::where('id', $id)->first();

        $barang->stok = $barang->stok()->get();
        return $barang;
    }

    public function getLatestBarang($limit){
        $barangAll = Barang::latest()->limit($limit)->get();

        foreach ($barangAll as $barang) {
            $barang->stok = $barang->stok()->get();
        }
        
        return $barangAll;
    }

    public function getKategoriByGender($id)
    {
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
        return Barang::destroy($id);
    }
}

?>