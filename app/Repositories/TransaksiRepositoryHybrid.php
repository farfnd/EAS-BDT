<?php

namespace App\Repositories;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use App\Models\PembayaranDetail;
use App\Models\Stok;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiRepositoryHybrid{
    protected $barang;
    protected $keranjang;
    protected $pembayaran;
    
    public function __construct(Barang $barang, Keranjang $keranjang, Pembayaran $pembayaran, PembayaranDetail $pembayaranDetail)
    {
        $this->barang = $barang;
        $this->keranjang = $keranjang;
        $this->pembayaran = $pembayaran;
        $this->pembayaranDetail = $pembayaranDetail;
    }
    
    /* ========================================================================
        START ::: KERANJANG SERVICES
    ======================================================================== */
    public function getUserKeranjang()
    {
        return Keranjang::where('user_id', Auth::id())->get();
    }

    public function postKeranjang($id)
    {
        $keranjang = new $this->keranjang;
        
        $keranjang->barang_id = (int) $id;
        $keranjang->user_id = Auth::user()->id;
        $keranjang->jumlah = 1;
        $keranjang->save();

        return $keranjang->latest()->first();
    }

    public function destroyKeranjang($id)
    {
        return Keranjang::where([
            ['barang_id','=', (int) $id],
            ['user_id','=', Auth::user()->id],
        ])->delete();
    }

    public function updateKeranjang($id, $count)
    {
        // var_dump($count);
        return Keranjang::where([
            ['barang_id','=', (int) $id],
            ['user_id','=', Auth::user()->id],
        ])->update(["jumlah" => (int) $count]);
    }
    /* ========================================================================
        END ::: KERANJANG SERVICES
    ======================================================================== */

    /* ========================================================================
        START ::: TRANSAKSI SERVICES
    ======================================================================== */
    public function getAllBanks()
    {
        return DB::table('banks')->get();
    }

    public function updateBuktiTransaksi($data)
    {
        $data['bukti']->storeAs('transactions', $data['bukti']->getClientOriginalName());
        $data['bukti'] = $data['bukti']->getClientOriginalName();

        $id = $data['id'];
        return Pembayaran::where('id', $id)->first()->update(
            [
                "nama_pemilik_rekening" => $data['nama_pemilik_rekening'],
                "nama_bank" => $data['nama_bank'],
                "no_rekening" => $data['no_rekening'],
                "bukti" => $data['bukti'],
                "status_pembayaran" => 'Belum Terverifikasi'
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
        $pembayaran->catatan_pengiriman = $data['catatan_pengiriman'];
        $pembayaran->user_id = Auth::id();
        $temp_total_harga = 0;

        foreach($data['data_barang'] as $id => $jumlah) {
            $temp_harga = Barang::find($id)->harga;
            $temp_total_harga += $jumlah * $temp_harga;
        }
        
        if($pembayaran->metode == 'va'){
            $pembayaran->metode = $data['va-bank-select'];
            $pembayaran->total_pembayaran = (int) $temp_total_harga*1000;
        } else if($pembayaran->metode == 'bank'){
            $pembayaran->kode_unik = rand(100,999);
            $pembayaran->total_pembayaran = (int) $temp_total_harga*1000 + $pembayaran->kode_unik;
        }
        
        $pembayaran->save();
        
        foreach($data['data_barang'] as $id => $jumlah) {
            $temp_harga = Barang::find($id)->harga;
            $pembayaranDetail = new $this->pembayaranDetail;
            $pembayaranDetail->pembayaran_id = $pembayaran->id;
            $pembayaranDetail->barang_id = $id;
            $pembayaranDetail->jumlah_barang = $jumlah;
            $pembayaranDetail->total_harga = $jumlah * $temp_harga;

            Keranjang::where([['barang_id', (int) $id], ['user_id', Auth::id()]])->delete();
            $pembayaranDetail->save();
        }

        return $pembayaran->where('id', $randomId)->first();
    }

    public function getPembayaran($id)
    {
        $pembayaran = Pembayaran::where('id', $id)->first();
        if(str_starts_with($pembayaran->metode, 'va_')) $pembayaran->no_va = '79029000'.$this->random_str(5, '0123456789');

        return $pembayaran;
    }

    public function destroyPembayaran($id)
    {
        PembayaranDetail::where('pembayaran_id', $id)->delete();
        return Pembayaran::where('id', $id)->delete();
    }

    public function getTransaksiHistory() {
        $pembayaranAll = Pembayaran::where('user_id', Auth::id())->where("status_pembayaran", 'Lunas')->get();
        foreach ($pembayaranAll as $pembayaran) {
            foreach ($pembayaran->pembayaranDetail as $pembayaranDetail) {
                if ($pembayaranDetail->barang->ulasan->where('user_id', Auth::id())->count()){
                    $pembayaranDetail->barang->isReviewed = 1;
                }
                continue;
            }
        }

        return $pembayaranAll;
    }

    public function getUserTransaksi() {
        return Auth::user()->pembayaran;
    }

    /* ========================================================================
        END ::: TRANSAKSI SERVICES
    ======================================================================== */

    /* ========================================================================
        START ::: ADMIN SERVICES
    ======================================================================== */
    public function getAllTransaksi() {
        return Pembayaran::all();
    }

    public function getTransaksi($id){
        $transaksi = Pembayaran::where('id', $id)->first();
        $transaksi->nama = $transaksi->user->nama;
        return $transaksi;
    }

    public function putTransaksi($data)
    {
        return Pembayaran::where('id', $data['id'])->first()->update(['status_pembayaran' => $data['status_pembayaran']]);
    }
    /* ========================================================================
        END ::: ADMIN SERVICES
    ======================================================================== */
}

?>