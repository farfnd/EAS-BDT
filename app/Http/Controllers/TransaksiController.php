<?php

namespace App\Http\Controllers;

use App\Services\TransaksiService;
use Exception;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    protected $transaksiService;

    public function __construct(TransaksiService $transaksiService)
    {
        $this->transaksiService = $transaksiService;
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

    public function show_detail_transaksi($id = null)
    {
        $bankAll = $this->transaksiService->readAllBanks();
        return view('pages.payments.details', ['bankAll' => $bankAll]);
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

    public function show_checkout()
    {
        return view('pages.checkout');
    }

    public function post_pembayaran(Request $request)
    {
        $input = $request->except(['_token']);
        $result = ['status' => 200];

        try{
            $result['data'] = $this->transaksiService->createPayment($input);
            if($result['data']->metode == 'bank') return redirect(route('bank-payment', $result['data']->id));
            else if(str_starts_with($result['data']->metode, 'va_')) return redirect(route('va-payment', $result['data']->id));
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
            dd($result);
        }
    }

    public function show_bank_payment($id)
    {
        $pembayaran = $this->transaksiService->readPembayaran($id);
        return view('pages.payments.bank', ['pembayaran' => $pembayaran]);
    }

    public function show_va_payment($id)
    {
        $pembayaran = $this->transaksiService->readPembayaran($id);
        return view('pages.payments.virtual-account', ['pembayaran' => $pembayaran]);
    }

}
