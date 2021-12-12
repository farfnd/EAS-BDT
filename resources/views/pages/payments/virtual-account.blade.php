@php
$bni_list = ['ATM BNI', 'Mobile Banking', 'IBank Personal BNI', 'Cabang atau Outlet BNI', 'SMS Banking', 'Agen46', 'ATM Bersama'];
@endphp

<x-layout titlePage="Hanaka | Payment">
    <div class="mx-4 md:mx-0">
        {{-- header  --}}
        <div class="w-full md:w-10/12 mx-auto text-center mb-8">
            <h2 class="text-2xl my-8 font-bold">Pembayaran via Transfer Bank</h2>
            <p class="md:w-8/12 mx-auto">
                Selesaikan pembayaran sebelum <strong>31-12-2021 23:59</strong> untuk menghindari pembatalan pesanan
                secara otomatis.
            </p>
        </div>
        <div class="w-full md:w-10/12 mx-auto text-center mb-8">
            <div class="flex justify-between md:w-8/12 mx-auto">
                <p class="font-bold text-lg">Nomor Pesanan</p>
                <p class="font-bold text-lg">{{$pembayaran->id}}</p>
            </div>
            <hr class="my-2">
        </div>

        {{-- informasi bank  --}}
        <div class="shadow-custom1 rounded-lg w-full md:w-10/12 mx-auto mb-8 pb-6">
            <div class="flex justify-between mx-auto px-6 pt-6">
                @if ($pembayaran->metode == 'va_bca')
                    <p class="font-bold text-lg">Bank BCA</p>
                    <p class="font-bold text-lg">**logo bca**</p>
                @elseif ($pembayaran->metode == 'va_bni')  
                    <p class="font-bold text-lg">Bank BNI</p>
                    <p class="font-bold text-lg">**logo bni**</p>
                @elseif ($pembayaran->metode == 'va_mandiri')  
                    <p class="font-bold text-lg">Bank Mandiri</p>
                    <p class="font-bold text-lg">**logo mandiri**</p>
                @endif
            </div>
            <hr class="my-2">
            <div class="flex justify-between md:w-8/12 mx-6 md:mx-auto">
                <p class="font-bold text-lg">Nomor Virtual Account</p>
                <p class="font-bold text-lg">790012012653244</p>
            </div>
            <hr class="my-2 md:w-8/12 mx-auto">
            <div class="flex justify-between md:w-8/12 mx-6 md:mx-auto">
                <p class="font-bold text-lg">Total Nominal Transfer</p>
                <p class="font-bold text-lg">Rp{{number_format($pembayaran->total_pembayaran, 0, ',', '.')}}</p>
            </div>
        </div>

        {{-- cara pembayaran section  --}}
        <div class="w-full md:w-10/12 mx-auto mb-8">
            <p class="text-2xl text-center font-bold">Cara Pembayaran</p>
            <hr class="mt-2 mb-6">
            @foreach ($bni_list as $list)
                <div data-micromodal-trigger="pembayaran-atm" class="rounded-lg flex justify-between items-center p-2 mb-4 shadow-md hover:shadow-lg hover:scale-105 duration-200 cursor-pointer">
                    <p class="font-bold text-lg">{{ $list }}</p>
                    <i class='bx bx-chevron-right'></i>
                </div>
            @endforeach
        </div>

        {{-- button section  --}}
        <div class="flex justify-center gap-8 w-full md:w-10/12 mx-auto text-center mb-8">
            <a href="{{ route('home') }}" class="rounded-lg p-2 w-3/12 text-white bg-gray-800 hover:bg-gray-900">
                Belanja Lagi
            </a>
            {{-- ========================================================================
                TODO ::: UBAH ROUTE INI JADI KE DETAIL TRANSAKSI
            ======================================================================== --}}
            <a href={{ route('home') }} class="rounded-lg p-2 w-3/12 text-white bg-gray-800 hover:bg-gray-900">
                Lihat Detail Transaksi
            </a>
        </div>
    </div>
    {{-- modal pembayaran via atm  --}}
    <div class="modal micromodal-slide" id="pembayaran-atm" aria-hidden="true">
        <div class="modal__overlay" data-micromodal-close>
        <div class="modal__container" role="dialog" 
            aria-modal="true" aria-labelledby="edit-barang-title"
            style="width: 55rem; display: flex; 
                    flex-direction: column; justify-content: space-between; margin: 0 1rem;">
            <div>
                <header class="modal__header border-b-2 pb-1">
                    <h2 class="modal__title text-center" id="edit-barang-title" style="font-size: 1.8rem">
                        Pembayaran via ATM BNI
                    </h2>
                </header>
                <main class="modal__content mt-3" id="edit-barang-content">
                    <ol class="list-decimal flex flex-col space-y-3 px-5 font-semibold">
                        <li>Masukkan Kartu Anda.</li>
                        <li>Pilih Bahasa.</li>
                        <li>Masukkan PIN ATM Anda.</li>
                        <li>Pilih "Menu Lainnya".</li>
                        <li>Pilih "Transfer".</li>
                        <li>Pilih Jenis rekening yang akan Anda gunakan (Contoh: "Dari Rekening Tabungan").</li>
                        <li>Pilih "Virtual Account Billing".</li>
                        <li>Masukkan nomor Virtual Account Anda (contoh: 7900120124653244).</li>
                        <li>Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi.</li>
                        <li>Konfirmasi, apabila telah sesuai, lanjutkan transaksi.</li>
                        <li>Transaksi telah selesai.</li>
                    </ol>
                </main>
                <footer class="modal__footer flex justify-end">
                    <button class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-lg px-4 py-1  edit-submit-btn" data-micromodal-close>Tutup</button>
                </footer>
            </div>
        </div>
        </div>
    </div>
</x-layout>
