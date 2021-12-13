<x-layout titlePage="Hanaka | Bank Transfer Payment Details">
    <div class="mx-4 md:mx-0">
        <div class="w-full md:w-10/12 mx-auto text-center mb-8">
            <h2 class="text-2xl my-8 font-bold">Pembayaran via Transfer Bank</h2>
            <p>
                Selesaikan pembayaran sebelum <strong>31-12-2021 23:59</strong> untuk menghindari pembatalan pesanan
                secara otomatis.
            </p>
        </div>
        <div class="w-full md:w-10/12 mx-auto text-center mb-8">
            <div class="flex justify-between md:w-8/12 mx-auto">
                <p class="font-bold text-lg">Nomor Pesanan</p>
                <p class="font-bold text-lg">{{ $pembayaran->id }}</p>
            </div>
            <hr class="my-2">
            <div class="md:w-8/12 mx-auto">
                <div class="flex justify-between">
                    <p class="text-lg">Total Pesanan</p>
                    <p class="text-lg">
                        Rp{{ number_format($pembayaran->total_pembayaran - $pembayaran->kode_unik, 0, ',', '.') }}</p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p class="text-lg">Kode Unik</p>
                    <p class="text-lg">Rp{{ $pembayaran->kode_unik }}</p>
                </div>
                <hr class="my-2">
            </div>
            <div class="flex justify-between md:w-8/12 mx-auto mt-4">
                <p class="font-bold text-lg">Total Nominal Transfer</p>
                <p class="font-bold text-lg">
                    Rp{{ number_format(substr($pembayaran->total_pembayaran, 0, -3), 0, ',', '.') }}.<span
                        class="text-red-500 m-0 p-0">{{ substr($pembayaran->total_pembayaran, -3) }}</span>
                </p>
            </div>
            <hr class="my-2">
            <p class="text-center font-bold">Pastikan nominal yang ditransfer sesuai hingga 2 digit terakhir</p>
        </div>

        <div class="w-full md:w-10/12 mx-auto mb-8">
            <p class="text-2xl text-center font-bold">Cara Pembayaran</p>
            <hr class="my-2">
            <div class="mx-8">
                <ol class="list-decimal">
                    <li class="pl-4">
                        Transfer melalui ATM, teller bank, aplikasi mobile banking, atau internet banking sejumlah tepat
                        <strong>Rp{{ number_format($pembayaran->total_pembayaran, 0, ',', '.') }}</strong> ke nomor
                        rekening berikut:
                        <ul class="list-disc ml-4">
                            <li class="pl-4">Nomor rekening: <strong>6110421883</strong> </li>
                            <li class="pl-4">Nama pemilik rekening: <strong>Kadek Mayang Devi</strong></li>
                            <li class="pl-4">Bank: <strong>BCA</strong></li>
                        </ul>
                    </li>
                    <li class="pl-4">
                        Simpan bukti transaksi, lalu unggah melalui menu ‘Unggah Bukti Transfer’ pada halaman detail
                        transaksi.
                    </li>
                    <li class="pl-4">
                        Isi data sesuai rekening yang Anda gunakan saat melakukan transfer. Jika Anda melakukan transfer
                        melalui teller bank, isi ‘0000’ pada kolom nomor rekening, dan nama Anda pada kolom nama pemilik
                        rekening.
                    </li>
                </ol>
            </div>
        </div>

        <div class="flex justify-center gap-8 w-full md:w-10/12 mx-auto text-center mb-8">
            <a href="{{ route('home') }}" class="rounded-lg p-2 w-3/12 text-white bg-gray-800 hover:bg-gray-900">
                Belanja Lagi
            </a>
            {{-- ========================================================================
                TODO ::: UBAH ROUTE INI JADI KE DETAIL TRANSAKSI
            ======================================================================== --}}
            <a href={{ route('payment-detail', $pembayaran->id) }}
                class="rounded-lg p-2 w-3/12 text-white bg-gray-800 hover:bg-gray-900">
                Lihat Detail Transaksi
            </a>
        </div>
    </div>
</x-layout>
