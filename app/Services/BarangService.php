<?php

namespace App\Services;

use App\Repositories\BarangRepository;
use App\Repositories\BarangRepositoryHybrid;

class BarangService
{
    protected $barangRepository;

    public function __construct(BarangRepositoryHybrid $barangRepository)
    {
        $this->barangRepository = $barangRepository;
    }

    // create
    public function saveBarang($data){
        return $this->barangRepository->save($data);
    }
    
    // read all barang
    public function readAllBarang(){
        return $this->barangRepository->getAllBarang();
    }

    // read latest barang
    public function readLatestBarang($limit){
        return $this->barangRepository->getLatestBarang($limit);
    }

    // read one barang
    public function readBarang($id){
        return $this->barangRepository->getBarang($id);
    }

    // read barang by gender
    public function readAllBarangByGender($id){
        return $this->barangRepository->getAllBarangByGender($id);
    }

    // read kategori barang by gender
    public function readKategoriByGender($id){
        return $this->barangRepository->getKategoriByGender($id);
    }
    
    // update
    public function editBarang($input){
        return $this->barangRepository->putBarang($input);
    }

    // delete
    public function deleteBarang($id){
        return $this->barangRepository->destroyBarang($id);
    }

    // add barang to wishlist
    public function addToWishlist($id){
        return $this->barangRepository->postToWishlist($id);
    
    }
    // add barang to wishlist
    public function deleteFromWishlist($id){
        return $this->barangRepository->destroyFromWishlist($id);
    }

    // read all barang di wishlist
    public function readAllWishlist(){
        return $this->barangRepository->getAllWishlist();
    }

    // create ulasan
    public function createUlasan($input){
        return $this->barangRepository->postUlasan($input);
    }
}
