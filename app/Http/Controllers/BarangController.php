<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BarangService;

class BarangController extends Controller
{
    protected $barangService;

    public function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    public function index()
    {
        $latestBarangAll = $this->barangService->readLatestBarang(10);
        return view('pages.home', ['latestBarangAll' => $latestBarangAll]);
    }

    public function index_admin()
    {
        $barangAll = $this->barangService->readAllBarang();
        return view('pages.admin.barang', ['barangAll' => $barangAll]);
    }

    public function create(Request $request)
    {
        $input = $request->except(['_token']);
        $result = ['status' => 200];

        try{
            $result['data'] = $this->barangService->saveBarang($input);
            return redirect(route('admin.barang'));
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
            dd($result); die();
        }
    }

    public function showBarangDetail($id)
    {
        $barang = $this->barangService->readBarang($id);
        $barang->ulasan = $barang->ulasan()->get();

        return view('pages.item-page', ['barang' => $barang]);
    }

    public function getKategori($id)
    {   
        return $this->barangService->readKategoriByGender($id);
    }

    public function getBarang($id)
    {   
        return $this->barangService->readBarang($id);
    }

    public function update(Request $request)
    {
        $input = $request->except(['_token']);
        $result = ['status' => 200];

        try{
            $result['data'] = $this->barangService->editBarang($input);
            return redirect(route('admin.barang'));
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
            dd($result); die();
        }
    }

    public function delete($id)
    {
        return $this->barangService->deleteBarang($id);
    }
}
