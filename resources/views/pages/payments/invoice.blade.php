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

@php
$json = '' . $pembayaran->alamat . '';
$res = json_decode($json);
$curDate = strtotime($pembayaran->created_at);
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

    <style>
        @media print
        {    
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body class="antialiased lg:mx-auto font-poppins max-w-7xl m-8">

    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-4">
            <div class="relative">
                <a class="absolute top-0 left-0 right-0 bottom-0" href="/"></a>
                <h2 class="font-arial font-semibold text-1xl md:text-2xl">HANAKA &amp; CO.</h2>
            </div>
            <div class="relative">
                <button class="cursor-pointer px-4 py-2 rounded-lg bg-gray-800 hover:bg-gray-900 text-white no-print" onclick="window.print()"><i class='bx bx-printer'></i> Cetak</button>
            </div>
        </div>
        <div class="mb-4">
            <h4 class="font-bold">Invoice Transaksi</h4>
            <p>Invoice ini merupakan bukti transfer yang sah.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 justify-between mb-4">
            <div>
                <h4 class="font-bold">Nomor Transaksi</h4>
                <p>{{ $pembayaran->id }}</p>
            </div>
            <div>
                <h4 class="font-bold">Tanggal Transaksi</h4>
                <p>{{ date('d F Y', strtotime($pembayaran->created_at)) }}</p>
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
                <p>{{ $res->nama_penerima }}</p>
                <p>{{ $res->alamat . ', ' . $res->kecamatan . ', ' . $res->kota_kab . ', ' . $res->provinsi }}</p>
                <p>(+62) {{ $res->no_telepon }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 justify-between mb-4">
            <div>
                <h4 class="font-bold">Status Transaksi</h4>
                @if ($pembayaran->status_pembayaran == 'Lunas')
                    <p class="text-green-500">Lunas</p>
                @else
                    <p class="text-red-500">Belum Lunas</p>
                @endif
            </div>
            <div>
                <h4 class="font-bold">Metode Pembayaran</h4>
                <p>
                    @if ($pembayaran->metode == 'bank')
                    Transfer Bank
                    @elseif ($pembayaran->metode == 'va_mandiri')
                    Transfer Virtual Account (Mandiri)
                    @elseif ($pembayaran->metode == 'va_bca')
                    Transfer Virtual Account (BCA)
                    @elseif ($pembayaran->metode == 'va_bni')
                    Transfer Virtual Account (BNI)
                    @endif
                </p>
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

            @foreach ($pembayaranDetail as $detail)
                <div class="col-span-4 p-2 border-b-2 border-gray-200">
                    <p class="">{{ $detail->barang->nama }}</p>
                </div>
                <div class="col-span-2 p-2 border-b-2 border-gray-200">
                    <p class="text-center">{{ $detail->jumlah_barang }}</p>
                </div>
                <div class="col-span-3 p-2 border-b-2 border-gray-200">
                    <p class="text-center">Rp{{ number_format($detail->barang->harga * 1000, 0, ',', '.') }}</p>
                </div>
                <div class="col-span-3 p-2 border-b-2 border-gray-200">
                    <p class="text-right">
                        Rp{{ number_format($detail->jumlah_barang * $detail->barang->harga * 1000, 0, ',', '.') }}
                    </p>
                </div>
            @endforeach

            <div class="col-span-6 p-4 row-span-4 flex justify-center items-center">
                @if ($pembayaran->status_pembayaran == 'Lunas')
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
                Rp{{ number_format($pembayaran->total_pembayaran - $pembayaran->kode_unik, 0, ',', '.') }}
            </div>
            <div class="col-span-3 font-bold px-2 text-right">
                Ongkos Kirim
            </div>
            <div class="col-span-3 px-2 text-right">
                Rp{{ number_format(10000, 0, ',', '.') }}
            </div>
            <div class="col-span-3 font-bold px-2 text-right">
                Kode Unik
            </div>
            <div class="col-span-3 px-2 text-right">
                Rp{{ number_format($pembayaran->kode_unik, 0, ',', '.') }}
            </div>
            <div class="col-span-6 grid grid-cols-2 p-4 my-2 -mr-3 rounded-3xl border-4 border-gray-300">
                <p class="col-span-1 font-bold text-right pr-4">Total Pembayaran</p>
                <p class="col-span-1 text-right">
                    Rp{{ number_format($pembayaran->total_pembayaran, 0, ',', '.') }}</p>
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
