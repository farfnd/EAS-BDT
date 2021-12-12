@php
$isLunas = true;
$ongkir = 15000;
$kode_unik = 67;
$totalHarga = 0;

class items
{
    public $nama;
    public $jumlah;
    public $harga_barang;
}

$items = [];
$items[0] = new items();
$items[0]->nama = 'test';
$items[0]->jumlah = 2;
$items[0]->harga_barang = 125000;

$items[1] = new items();
$items[1]->nama = 'test2';
$items[1]->jumlah = 3;
$items[1]->harga_barang = 100000;

foreach ($items as $item) {
    $totalHarga += $item->harga_barang * $item->jumlah;
}

@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>INVOICE</title>

    {{-- ======== FONTS ======== --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    {{-- ======== CSS ======== --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>

    {{-- ======== JS ======== --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="antialiased lg:mx-auto font-poppins max-w-7xl m-8">

    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <div class="relative">
                <a class="absolute top-0 left-0 right-0 bottom-0" href="/"></a>
                <h2 class="font-arial font-semibold text-1xl md:text-2xl">HANAKA &amp; CO.</h2>
            </div>
            <div class="relative">
                <a class="cursor-pointer px-4 py-2 rounded-lg bg-gray-800 hover:bg-gray-900 text-white"><i
                        class='bx bx-printer'></i> Cetak</a>
            </div>
        </div>
        <div class="mb-4">
            <h4 class="font-bold">Invoice Transaksi</h4>
            <p>Invoice ini merupakan bukti transfer yang sah.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 justify-between mb-4">
            <div>
                <h4 class="font-bold">Nomor Transaksi</h4>
                <p>A0001</p>
            </div>
            <div>
                <h4 class="font-bold">Tanggal Transaksi</h4>
                <p>29 Desember 2021</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 justify-between mb-4">
            <div>
                <h4 class="font-bold">Pengirim</h4>
                <p>Hanaka & Co.</p>
                <p>Jl. Tukad Pakerisan No. 69d Panjer, Denpasar Selatan Denpasar, Bali 80225</p>
                <p>0812 3902 1620</p>
            </div>
            <div>
                <h4 class="font-bold">Tujuan Pengiriman</h4>
                <p>Michael Alexander</p>
                <p>Jl. Banyuwangi No. 10 Abiansemal MENGWI, KABUPATEN BADUNG BALI 18990</p>
                <p>(+62) 812-3456-7890</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 justify-between mb-4">
            <div>
                <h4 class="font-bold">Status Transaksi</h4>
                @if ($isLunas)
                    <p class="text-green-500">Lunas</p>
                @else
                    <p class="text-red-500">Belum Lunas</p>
                @endif
            </div>
            <div>
                <h4 class="font-bold">Metode Pembayaran</h4>
                <p>Transfer Bank</p>
            </div>
        </div>

        <div class="grid grid-cols-12 justify-between mb-4">
            <div class="col-span-4 p-2 bg-gray-300">
                <p class="font-bold">Nama Barang</p>
            </div>
            <div class="col-span-2 p-2 bg-gray-300">
                <p class="font-bold text-center">Jumlah</p>
            </div>
            <div class="col-span-3 p-2 bg-gray-300">
                <p class="font-bold text-center">Harga Barang</p>
            </div>
            <div class="col-span-3 p-2 bg-gray-300">
                <p class="font-bold text-right">Subtotal</p>
            </div>

            @foreach ($items as $item)
                <div class="col-span-4 p-2 border-b-2 border-gray-200">
                    <p class="">{{ $item->nama }}</p>
                </div>
                <div class="col-span-2 p-2 border-b-2 border-gray-200">
                    <p class="text-center">{{ $item->jumlah }}</p>
                </div>
                <div class="col-span-3 p-2 border-b-2 border-gray-200">
                    <p class="text-center">Rp{{ number_format($item->harga_barang, 0, ',', '.') }}</p>
                </div>
                <div class="col-span-3 p-2 border-b-2 border-gray-200">
                    <p class="text-right">Rp{{ number_format($item->jumlah * $item->harga_barang, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach

            <div class="col-span-6 p-4 row-span-4 flex justify-center items-center">
                @if ($isLunas)
                    <div class="text-4xl font-bold text-green-500 rounded-lg px-8 py-4 border-4 border-green-500">
                        LUNAS
                    </div>
                @else
                    <div class="text-4xl font-bold text-red-500 rounded-lg px-8 py-4 border-4 border-red-500">
                        BELUM LUNAS
                    </div>
                @endif
            </div>

            <div class="col-span-3 font-bold px-2 pt-2 text-right">
                Subtotal Harga Produk
            </div>
            <div class="col-span-3 px-2 pt-2 text-right">
                Rp{{ number_format($totalHarga, 0, ',', '.') }}
            </div>
            <div class="col-span-3 font-bold px-2 text-right">
                Ongkos Kirim
            </div>
            <div class="col-span-3 px-2 text-right">
                Rp{{ number_format($ongkir, 0, ',', '.') }}
            </div>
            <div class="col-span-3 font-bold px-2 text-right">
                Kode Unik
            </div>
            <div class="col-span-3 px-2 text-right">
                Rp{{ number_format($kode_unik, 0, ',', '.') }}
            </div>
            <div class="col-span-6 grid grid-cols-2 p-4 my-2 -mr-3 rounded-3xl border-4 border-gray-300">
                <p class="col-span-1 font-bold text-right pr-4">Total Pembayaran</p>
                <p class="col-span-1 text-right">
                    Rp{{ number_format($totalHarga + $ongkir + $kode_unik, 0, ',', '.') }}</p>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        $(document).ready(() => {
            MicroModal.init({
                awaitCloseAnimation: true,
                disableFocus: true,
            });
        })
    </script>
</body>

</html>
