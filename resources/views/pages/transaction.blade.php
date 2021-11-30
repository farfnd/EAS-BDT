<x-layout titlePage="Hanaka | Transaction">
    <div class="md:mx-8">
        <x-navbar></x-navbar>

        <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">Daftar Transaksi</h2>
        <div class="flex flex-col space-y-5 mx-8 mt-4 mb-6">
            @for ($i = 0; $i < 2; $i++)        
                {{-- card 1 item--}}
                <div class="flex flex-col md:flex-row shadow-custom1 rounded-2xl justify-between px-4 py-3 ">
                    {{-- item detail --}}
                    <div class="flex">
                        <img class="rounded-md w-36" src="{{ asset('images/jacket.png') }}" alt="item image">
                        <div class="flex flex-col justify-between py-2 ml-3">
                            <div>
                                <p class="font-medium">Transaksi: <span class="font-semibold">A0012 / 23 Mei 2021</span></p>
                                <p class="text-lg font-semibold">Sweater Logo Fav Maroon</p>
                                <p>@ Rp 335.000,00</p>
                            </div>
                            <div>
                                <p>Jumlah : 1</p>
                                <p>Total Harga: <span class="font-semibold">Rp 335.000,00</span></p>
                            </div>
                        </div>
                    </div>
                    {{-- item payment status --}}
                    <div class= "flex flex-col justify-between py-2">
                        <div class="md:text-right p-3 md:p-0">
                            <p>Status Pembayaran</p>
                            <p class="font-bold">Belum Dibayar</p>
                        </div>
                        <div>
                            <button class="relative w-full bg-gray-800 hover:bg-opacity-90 rounded-lg px-2 py-1 mt-4">
                                <p class="font-semibold text-white text-center">Bayar</p>
                            </button>
                        </div>
                    </div>
                </div>
                {{-- card 2 item--}}
                <div class="flex flex-col md:flex-row shadow-custom1 rounded-2xl justify-between px-4 py-3 ">
                    {{-- item detail --}}
                    <div class="flex">
                        <img class="rounded-md w-36" src="{{ asset('images/shirt.png') }}" alt="item image">
                        <div class="flex flex-col justify-between py-2 ml-3">
                            <div>
                                <p class="font-medium">Transaksi: <span class="font-semibold">A0012 / 23 Mei 2021</span></p>
                                <p class="text-lg font-semibold">Sweater Logo Fav Maroon</p>
                                <p>dan 2 barang lainnya</p>
                            </div>
                            <div>
                                <p>Jumlah : 1</p>
                                <p>Total Harga: <span class="font-semibold">Rp 335.000,00</span></p>
                            </div>
                        </div>
                    </div>
                    {{-- item payment status --}}
                    <div class= "flex flex-col justify-between py-2">
                        <div class="md:text-right p-3 md:p-0">
                            <p>Status Pembayaran</p>
                            <p class="font-bold">Belum Dibayar</p>
                        </div>
                        <div>
                            <button class="relative w-full bg-gray-800 hover:bg-opacity-90 rounded-lg px-2 py-1 mt-4">
                                <p class="font-semibold text-white text-center">Bayar</p>
                            </button>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
      </div>
</x-layout>