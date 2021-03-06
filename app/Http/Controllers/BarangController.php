<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BarangService;
use Exception;

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
            die($result);
        }
    }

    public function show($id)
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
            die($result);
        }
    }

    public function delete($id)
    {
        return $this->barangService->deleteBarang($id);
    }

    public function addToWishlist($id)
    {
        return $this->barangService->addToWishlist($id);
    }

    public function deleteFromWishlist($id)
    {
        return $this->barangService->deleteFromWishlist($id);
    }

    public function show_category($genderId)
    {
        $barangAll = $this->barangService->readAllBarangByGender($genderId);
        return view('pages.category', ['barangAll' => $barangAll, 'id' => $genderId]);
    }

    public function show_wishlist()
    {
        $wishlistAll = $this->barangService->readAllWishlist();
        return view('pages.wishlist', ['wishlistAll' => $wishlistAll]);
    }

    public function postUlasan(Request $request)
    {
        $input = $request->except(['_token']);
        $result = ['status' => 200];

        try{
            return $this->barangService->createUlasan($input);
        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
            die($result);
        }
    }
}
