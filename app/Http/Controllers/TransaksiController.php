<?php

namespace App\Http\Controllers;

use App\Services\TransaksiService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function checkoutFromCart(Request $request) {
        // dd($request->input());
        $input = $request->except(['_token']);
        $temp_id = [];
        foreach($input as $key => $value){
            // array_push($temp_id, $value);
            $temp_id[] = $value;
        }
        $data = Auth::user()->keranjang->whereIn('barang_id', $temp_id);
        // Auth::user()->keranjang->whereIn('barang_id', $temp_id)->each(function($el){
        //     $test[] = $el->barang;
        //     dump($el->barang);
        //     array_push($test, $el->barang);
        // });
        // dd($data);
        return redirect()->route('checkout')->with(['data' => $data]);
    }
}
