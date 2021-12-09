<?php

namespace App\Services;

use App\Repositories\BarangRepository;

class BarangService
{
    protected $barangRepository;

    public function __construct(BarangRepository $barangRepository)
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

    // read one barang
    public function readBarang($id){
        return $this->barangRepository->getBarang($id);
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
}
