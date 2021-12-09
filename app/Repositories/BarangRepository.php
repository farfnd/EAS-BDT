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
        
        $names = [];
        
        foreach($data['foto'] as $productImage)
        {
            $path = $productImage->storeAs('products', $productImage->getClientOriginalName());
            array_push($names, $productImage->getClientOriginalName());
        }
        
        $barang->foto = json_encode($names);
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

        if(!$barang->foto){
            $names = [];
        }

        if($barang->foto){
            $names = json_decode($barang->foto);
        }

        if(isset($data['foto'])){
            foreach($data['foto'] as $userImage) {
                $path = $userImage->storeAs('products', $userImage->getClientOriginalName());
                array_push($names, $userImage->getClientOriginalName());
            }
            $data['foto'] = json_encode($names);
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