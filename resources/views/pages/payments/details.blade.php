@php
$count = 2;
$price = 2000000;
$ongkir = 15000;
$kode_unik = 67;
@endphp

<x-layout titlePage="Hanaka | Payment">
    <div class="mx-4 md:mx-0">
        <div class="w-full md:w-10/12 mx-auto text-center mb-4">
            <h2 class="text-2xl mt-8 mb-4 font-bold">Detail Pesanan</h2>
        </div>
        <div class="shadow-custom1 rounded-lg w-full md:w-10/12 mx-auto mb-8 p-6">
            <p class="text-center">
                Pesanan ini <strong>belum dibayar</strong> dan akan secara otomatis dibatalkan pada <strong>31-12-2021
                    23:59</strong>.
            </p>
            <hr class="my-2">
            <div class="flex justify-around w-full mx-auto text-center">
                <a class="cursor-pointer rounded-lg p-2 w-5/12 text-white bg-gray-800 hover:bg-gray-900">
                    Instruksi Pembayaran
                </a>
                {{-- ========================================================================
                TODO ::: UBAH ROUTE INI JADI KE DETAIL TRANSAKSI
            ======================================================================== --}}
                <a class="cursor-pointer rounded-lg p-2 w-5/12 text-white bg-gray-800 hover:bg-gray-900">
                    Unggah Bukti Transfer
                </a>
            </div>
        </div>
        <div class="shadow-custom1 rounded-lg w-full md:w-10/12 mx-auto mb-8 p-6">
            <div class="md:w-11/12 mx-auto">
                <div class="flex justify-between">
                    <p class="font-bold">Nomor Pesanan</p>
                    <p class="font-bold">A001</p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p>Status Pesanan</p>
                    <p>Belum Dibayar</p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p>Metode Pembayaran</p>
                    <p>Transfer Bank</p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p>Waktu Pemesanan</p>
                    <p>29-12-2021 23:59</p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p class="text-lg">Alamat Pengiriman</p>
                </div>
                <hr class="my-2">
                <div class="shadow-custom1 rounded-lg p-4 mb-4">
                    <p>Michael Alexander</p>
                    <p>(+62) 812-3456-7890</p>
                    <p>Jl. Banyuwangi No. 10 Abiansemal, MENGWI, KABUPATEN BADUNG, BALI, 18990</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-lg">Pesanan</p>
                </div>
                <hr class="my-2">
                @for ($i = 0; $i < 2; $i++)
                    <div class="mb-4">
                        <div class="flex content-center items-center space-x-4 rounded-lg shadow-custom1 p-4">
                            <div class="payment-detail-item-image-container rounded-lg"
                                style="background-image: url({{ asset('images/IMG_7800.jpg') }}); background-size: cover; backround-repeat: none">
                            </div>
                            <div class="flex flex-col flex-grow h-full">
                                <div>
                                    <h4 class="font-semibold">Baju baru ni</h4>
                                    <p class="">{{ $count }} x
                                        Rp{{ number_format($price, 2, ',', '.') }}</p>
                                </div>
                                <div class="flex justify-end items-center mt-auto">
                                    <p class="">{{ number_format($count * $price, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="flex justify-between w-full md:w-11/12 mx-auto mt-4 font-bold">
                <p class="font-bold text-lg">Total Pesanan</p>
                <p class="font-bold text-lg">
                    Rp{{ number_format($count * 2 * $price + $ongkir + $kode_unik, 2, ',', '.') }}</p>
            </div>
            <hr class="my-2 w-full md:w-11/12 mx-auto">
            <div class="shadow-custom1 rounded-lg w-full md:w-11/12 mx-auto mb-8 p-6">
                <div class="mx-auto">
                    <div class="flex justify-between">
                        <p>Subtotal Produk</p>
                        <p>Rp{{ number_format($count * 2 * $price, 2, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Ongkos Pengiriman</p>
                        <p>Rp{{ number_format($ongkir, 2, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Kode Unik</p>
                        <p>Rp{{ number_format($kode_unik, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center gap-8 w-full md:w-10/12 mx-auto text-center">
                <a href="{{ route('home') }}" class="rounded-lg p-2 w-3/12 text-white bg-gray-800 hover:bg-gray-900">
                    Cetak Invoice
                </a>
                {{-- ========================================================================
                    TODO ::: UBAH ROUTE INI JADI KE DETAIL TRANSAKSI
                ======================================================================== --}}
                <a href={{ route('home') }} class="rounded-lg p-2 w-3/12 text-white bg-red-600 hover:bg-red-700">
                    Batalkan Transaksi
                </a>
            </div>
        </div>
    </div>
</x-layout>
