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
        return Pembayaran::find($id)->first()->update(
            [
                "nama_pemilik_rekening" => $data['nama_pemilik_rekening'],
                "nama_bank" => $data['nama_bank'],
                "no_rekening" => $data['no_rekening'],
                "bukti" => $data['bukti'],
            ]
        );
    }

    private function random_str(
        int $length = 10,
        string $keyspace = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("Length must be a positive integer");
        }
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

    public function savePayment($data)
    {
        $pembayaran = new $this->pembayaran;
        
        $randomId = $this->random_str();
        while (Pembayaran::find($randomId)){
            $randomId = $this->random_str();
        }

        $pembayaran->id = $randomId;

        $jsonProvinsi = file_get_contents('https://ibnux.github.io/data-indonesia/provinsi.json');
        $objProvinsi = json_decode($jsonProvinsi);

        $alamat = array(
            'nama_penerima' => $data['nama_penerima'], 
            'alamat' => $data['alamat']
        );

        foreach ($objProvinsi as $key => $prov) {
            if($prov->id == $data['provinsi']) {
                $alamat['provinsi'] = $prov->nama;
                break;
            }
        }
        
        $jsonKotaKab = file_get_contents('https://ibnux.github.io/data-indonesia/kabupaten/'.$data['provinsi'].'.json');
        $objKotaKab = json_decode($jsonKotaKab);
        
        foreach ($objKotaKab as $key => $kotakab) {
            if($kotakab->id == $data['kota_kab']) {
                $alamat['kota_kab'] = $kotakab->nama;
                break;
            }
        }

        $jsonKec = file_get_contents('https://ibnux.github.io/data-indonesia/kecamatan/'.$data['kota_kab'].'.json');
        $objKec = json_decode($jsonKec);
        
        foreach ($objKec as $key => $kec) {
            if($kec->id == $data['kecamatan']) {
                $alamat['kecamatan'] = $kec->nama;
                break;
            }
        }

        $alamat['kode_pos'] = $data['kode_pos'];
        $alamat['no_telepon'] = $data['no_telepon'];
        
        $alamat = json_encode($alamat);
        
        $pembayaran->alamat = $alamat;
        $pembayaran->status_pembayaran = 'Belum Lunas';
        $pembayaran->metode = $data['metode'];
        if($pembayaran->metode = 'va'){
            $pembayaran->metode = $data['va-bank-select'];
            $pembayaran->total_pembayaran = (int) str_replace("Rp", "", str_replace(".", "", $data['total_pembayaran']));
        } else if($pembayaran->metode = 'bank'){
            $pembayaran->kode_unik = rand(100,999);
            $pembayaran->total_pembayaran = (int) str_replace("Rp", "", str_replace(".", "", $data['total_pembayaran'])) + $pembayaran->kode_unik;
        }
        $pembayaran->catatan_pengiriman = $data['catatan_pengiriman'];
        
        $pembayaran->save();
        
        return $pembayaran->fresh();
    }

    public function getPembayaran($id)
    {
        return Pembayaran::find($id)->first();
    }
}

?>