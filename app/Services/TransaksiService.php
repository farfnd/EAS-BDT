<?php

namespace App\Services;

use App\Repositories\TransaksiRepository;

class TransaksiService
{
    protected $transaksiRepository;

    public function __construct(TransaksiRepository $transaksiRepository)
    {
        $this->transaksiRepository = $transaksiRepository;
    }

    /* ========================================================================
        SECTION ::: KERANJANG
    ======================================================================== */
    public function readKeranjang()
    {   
        return $this->transaksiRepository->getUserKeranjang();
    }

    public function createKeranjang($id)
    {   
        return $this->transaksiRepository->postKeranjang($id);
    }

    public function deleteKeranjang($id)
    {   
        return $this->transaksiRepository->destroyKeranjang($id);
    }

    public function editKeranjang($id, $input)
    {   
        return $this->transaksiRepository->updateKeranjang($id, $input);
    }


    /* ========================================================================
        SECTION ::: TRANSAKSI
    ======================================================================== */
    public function readAllBanks()
    {   
        return $this->transaksiRepository->getAllBanks();
    }

    public function editBuktiTransaksi($input)
    {   
        return $this->transaksiRepository->updateBuktiTransaksi($input);
    }

    public function createPayment($input)
    {   
        return $this->transaksiRepository->savePayment($input);
    }

    public function readPembayaran($id)
    {   
        return $this->transaksiRepository->getPembayaran($id);
    }

    public function deletePembayaran($id)
    {   
        return $this->transaksiRepository->destroyPembayaran($id);
    }
    
    public function readTransaksiHistory()
    {   
        return $this->transaksiRepository->getTransaksiHistory();
    }

    /* ========================================================================
        SECTION ::: ADMIN SERVICES
    ======================================================================== */
    public function readAllTransaksi() {
        return $this->transaksiRepository->getAllTransaksi();
    }

    public function readTransaksi($id) {
        return $this->transaksiRepository->getTransaksi($id);
    }

    public function editTransaksi($data) {
        return $this->transaksiRepository->putTransaksi($data);
    }
}
