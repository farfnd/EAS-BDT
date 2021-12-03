<x-layout titlePage="Hanaka | Cart">
    <div class="md:mx-8">
        <x-navbar></x-navbar>

        {{-- TAMBAHIN INPUT PER ITEM, JADI BISA BELI LEBIH DARI 1 BARANG SEKALIGUS --}}
        <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">Keranjang</h2>
        <div class="grid grid-cols-8 gap-x-8 mx-8 mt-4">
            {{-- card section --}}
            <div class="col-span-8 lg:col-span-5 flex flex-col">
                <div class="flex flex-col space-y-8">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="flex content-center items-center space-x-4 rounded-lg shadow-custom1 p-4">
                            <input type="checkbox" name="" id="">
                            <div class="cart-item-image-container rounded-lg"
                                style="background-image: url({{ asset('images/IMG_7800.jpg') }}); background-size: cover; backround-repeat: none">
                            </div>
                            <div class="flex flex-col flex-grow h-full">
                                <div>
                                    <h4 class="text-lg font-semibold">Baju baru ni</h4>
                                    <p class="">Rp. 2.000.000,00</p>
                                </div>
                                <div class="flex justify-end items-center mt-auto">
                                    <p class="text-gray-400 hover:text-blue-500 cursor-pointer">Pindahkan ke Wishlist
                                    </p>
                                    <p class="text-gray-400">&nbsp;|&nbsp;</p>
                                    <div class="flex flex-col align-center"><i
                                            class='text-2xl text-gray-400 hover:text-blue-500 cursor-pointer bx bx-trash'></i>
                                    </div>
                                    <p class="text-gray-400">&nbsp;|&nbsp;</p>
                                    <div class="flex space-x-2">
                                        <i
                                            class='text-2xl text-gray-400 hover:text-blue-500 cursor-pointer bx bx-minus'></i>
                                        {{-- <input class="flex-shrink" type="number" name="" id=""> --}}
                                        <i
                                            class='text-2xl text-gray-400 hover:text-blue-500 cursor-pointer bx bx-plus'></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            {{-- total price --}}
            <div class="col-span-8 lg:col-span-3 mt-8 lg:mt-0">
                <div class="rounded-lg shadow-custom1 p-4">
                    <p class="font-semibold">Ringkasan Belanja</p>
                    <hr class="my-4 border-gray-800">
                    <div class="flex">
                        <p class="text-gray-400">Total Harga</p>
                        <p class="text-gray-400 ml-auto">Rp. xxx.xxx,xx</p>
                    </div>
                    <div class="flex">
                        <p class="text-gray-400">Total Diskon</p>
                        <p class="text-gray-400 ml-auto">Rp. xxx.xxx,xx</p>
                    </div>
                    <hr class="my-4 border-gray-800">
                    <div class="flex">
                        <p class="font-semibold">Total Belanja</p>
                        <p class="font-semibold ml-auto">Rp. xxx.xxx,xx</p>
                    </div>
                    <button class="relative w-full bg-gray-800 hover:bg-opacity-90 rounded-lg p-2 mt-4">
                        <a href="{{ route('checkout') }}">
                            <p class="font-semibold text-white text-center">Checkout</p>
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
