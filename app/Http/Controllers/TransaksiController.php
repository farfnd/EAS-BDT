<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\PembayaranDetail;
use App\Services\TransaksiService;
use App\Strategies\ChannelPembayaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller implements ChannelPembayaran
{
    protected $transaksiService;

    public function __construct(TransaksiService $transaksiService)
    {
        $this->transaksiService = $transaksiService;
    }

    public function show_cart () {
        $keranjangAll = $this->transaksiService->readKeranjang();
        return view('pages.cart', ['keranjangAll' => $keranjangAll]);
    }

    public function addToCart($id)
    {
        return $this->transaksiService->createKeranjang($id);
    }

    public function deleteFromCart($id)
    {
        return $this->transaksiService->deleteKeranjang($id);
    }

    public function editCart(Request $request, $id)
    {
        $data = $request->input();
        return $this->transaksiService->editKeranjang($id, $data['count']);
    }

    public function show_detail_transaksi($id)
    {
        $pembayaran = $this->transaksiService->readPembayaran($id);
        $pembayaranDetail = $pembayaran->pembayaranDetail;
        // dd($pembayaranDetail);
        $bankAll = $this->transaksiService->readAllBanks();
        return view('pages.payments.details', [
            'bankAll' => $bankAll,
            'pembayaran' => $pembayaran,
            'pembayaranDetail' => $pembayaranDetail,
        ]);
    }

    public function editBuktiTransfer(Request $request)
    {
        $input = $request->except(['_token']);
        $result = ['status' => 200];

        try{
            $result['data'] = $this->transaksiService->editBuktiTransaksi($input);
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
            dd($result);
        }
    }

    public function show_checkout(Request $request)
    {
        return view('pages.checkout');
    }

    public function post_pembayaran(Request $request)
    {
        $input = $request->except(['_token']);
        $result = ['status' => 200];
        $data_barang = [];
        foreach ($input as $key => $value) {
            if(str_contains($key, "barang-id-")){
                $string = explode("-", $key);
                // dump($string);
                $id_barang = end($string);
                $data_barang[$id_barang] = $value;
            }
        }
        $input['data_barang'] = $data_barang;

        try{
            $result['data'] = $this->transaksiService->createPayment($input);
            if($result['data']->metode == 'bank') {return redirect(route('bank-payment', $result['data']->id));}
            else if(str_starts_with($result['data']->metode, 'va_')) {return redirect(route('va-payment', $result['data']->id));};
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
            dd($result);
        }
    }

    public function show_payment_bank($id)
    {
        $pembayaran = $this->transaksiService->readPembayaran($id);
        if($pembayaran->metode == 'bank')
            return view('pages.payments.bank', ['pembayaran' => $pembayaran]);
        else return abort(404);
    }

    public function show_payment_va($id)
    {
        $pembayaran = $this->transaksiService->readPembayaran($id);
        if(str_starts_with($pembayaran->metode, 'va_'))
            return view('pages.payments.virtual-account', ['pembayaran' => $pembayaran]);
        else return abort(404);
    }

    public function checkoutFromCart(Request $request) {
        $input = $request->except(['_token']);
        if(!count($input)) {
            return redirect()->route('cart');
        }
        $temp_id = [];
        foreach($input as $key => $value){
            $temp_id[] = $value;
        }
        $data = Auth::user()->keranjang->whereIn('barang_id', $temp_id);
        return redirect()->route('checkout')->with(['data' => $data]);
    }

    public function show_invoice($id) {
        $pembayaran = $this->transaksiService->readPembayaran($id);
        $pembayaranDetail = $pembayaran->pembayaranDetail;
        return view('pages.payments.invoice', [
            'pembayaran' => $pembayaran,
            'pembayaranDetail' => $pembayaranDetail,
        ]);
    }
    
    public function show_transaction() {
        $pembayaran = $this->transaksiService->readUserTransaksi();
        // dd($pembayaran);
        return view('pages.transaction', [
            'pembayaran' => $pembayaran,
        ]);
    }

    public function show_transaction_history() {
        $pembayaran = $this->transaksiService->readTransaksiHistory();
        return view('pages.transactionHistory', [
            'pembayaran' => $pembayaran,
        ]);
    }

    public function batalkan_transaksi($id)
    {
        $result = ['status' => 200];

        try{
            $result['data'] = $this->transaksiService->deletePembayaran($id);
            return redirect(route('home'));
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
            dd($result);
        }
        
    }

    /* ========================================================================
        START ::: ADMIN PAGE CONTROLLER
    ======================================================================== */
    public function index_transaksi()
    {
        $transaksiAll = $this->transaksiService->readAllTransaksi();
        return view('pages.admin.transaksi', ['transaksiAll' => $transaksiAll]);
    }

    public function getTransaksi($id) {
        return $this->transaksiService->readTransaksi($id);
    }

    public function update_transaksi(Request $request)
    {
        $input = $request->except(['_token']);
        $result = ['status' => 200];

        try{
            $result['data'] = $this->transaksiService->editTransaksi($input);
            return redirect(route('admin.transaksi'));
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
            die($result);
        }
    }
    /* ========================================================================
        END ::: ADMIN PAGE CONTROLLER
    ======================================================================== */
}
