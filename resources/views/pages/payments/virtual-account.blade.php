@php
$bni_list = ['ATM BNI', 'Mobile Banking', 'IBank Personal BNI', 'Cabang atau Outlet BNI', 'SMS Banking', 'Agen46', 'ATM Bersama'];
@endphp

<x-layout titlePage="Hanaka | Payment">
    <div class="mx-4 md:mx-0">
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
                <p class="font-bold text-lg">A001</p>
            </div>
            <hr class="my-2">
        </div>

        <div class="shadow-custom1 rounded-lg w-full md:w-10/12 mx-auto mb-8 pb-6">
            <div class="flex justify-between mx-auto px-6 pt-6">
                <p class="font-bold text-lg">Bank BNI</p>
                <p class="font-bold text-lg">**logo bni**</p>
            </div>
            <hr class="my-2">
            <div class="flex justify-between md:w-8/12 mx-6 md:mx-auto">
                <p class="font-bold text-lg">Nomor Virtual Account</p>
                <p class="font-bold text-lg">790012012653244</p>
            </div>
            <hr class="my-2 md:w-8/12 mx-auto">
            <div class="flex justify-between md:w-8/12 mx-6 md:mx-auto">
                <p class="font-bold text-lg">Total Nominal Transfer</p>
                <p class="font-bold text-lg">Rpxxx.xxx</p>
            </div>
        </div>

        <div class="w-full md:w-10/12 mx-auto mb-8">
            <p class="text-2xl text-center font-bold">Cara Pembayaran</p>
            <hr class="mt-2 mb-6">
            @foreach ($bni_list as $list)
                <div
                    class="rounded-lg flex justify-between items-center p-2 mb-4 shadow-md hover:shadow-lg hover:scale-105 duration-200 cursor-pointer">
                    <p class="font-bold text-lg">{{ $list }}</p>
                    <i class='bx bx-chevron-right'></i>
                </div>
            @endforeach
        </div>

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
</x-layout>
