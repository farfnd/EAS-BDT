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

    public function createKeranjang($id)
    {   
        return $this->transaksiRepository->postKeranjang($id);
    }

    public function deleteKeranjang($id)
    {   
        return $this->transaksiRepository->destroyKeranjang($id);
    }

    public function editKeranjang($id, $count)
    {   
        return $this->transaksiRepository->updateKeranjang($id, $count);
    }

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
}
