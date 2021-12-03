<x-layout titlePage="Hanaka | Items">
    <div class="grid grid-cols-1 sm:grid-cols-2">
        {{-- image section --}}
        <div>
            <div class="item-image-container-responsive md:item-image-container-fixed bg-yellow-100 rounded-lg">
                {{-- ======== TODO ::: ADD IMAGE BERDASARKAN BARANG SEKARANG ======== --}}
                <img src="{{ asset('images/IMG_7800.jpg') }}" alt="" class="item-image">
            </div>
            <div class="flex flex-row px-8 space-x-2 text-sm md:text-base">
                <a href=""
                    class="flex flex-grow justify-center items-center shadow-md text-center p-2 rounded-lg border-2 border-gray-700 hover:opacity-80">
                    <div>Beli Langsung</div>
                </a>
                <a data-micromodal-trigger="add-keranjang"
                    class="cursor-pointer flex flex-grow justify-center items-center shadow-md bg-gray-700 text-white text-center p-2 rounded-lg border-2 border-gray-700 hover:opacity-80">
                    <div class="flex justify-center items-center"><i class='bx bx-plus'></i>&nbsp;Masukkan Keranjang
                    </div>
                </a>
            </div>
        </div>
        {{-- detail section --}}
        <div class="bg-gray-50 rounded-lg mt-4 ml-4 sm:ml-0 mr-4 sm:mr-8 p-4">
            <div>
                <h2 class="text-base md:text-lg font-semibold">Shibori Tie Dye</h2>
                <h5 class="text-base md:text-lg font-semibold">Rp. 165.000</h5>
                <h5 class="text-base md:text-lg mt-2">Deskripsi Barang</h5>
                <p class="text-sm md:text-base pl-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim hic
                    ducimus nemo odit tempora nostrum! Odit tenetur nisi incidunt dolorum harum fugiat aliquid aliquam,
                    porro quisquam architecto unde tempore vero eveniet libero possimus ipsa quae minima dolore culpa
                    velit inventore perspiciatis cumque? Eum asperiores, a fugit nesciunt ratione et repudiandae.</p>
            </div>
            <div class="mt-4">
                <h2 class="text-base md:text-lg font-semibold">Ulasan</h2>
                <div class="flex flex-col space-y-4 pt-2">

                    @for ($i = 0; $i < 3; $i++)
                        <!-- START PER USER ULASAN -->
                        <div class="grid grid-cols-12">
                            <div class="col-span-3">
                                <div class="item-image-container-responsive bg-gray-600 rounded-full"
                                    style="margin: 0 auto !important;">
                                    {{-- ======== TODO ::: ADD IMAGE USER BERDASARKAN USER IMAGE ======== --}}
                                    <img src="{{ asset('images/IMG_7800.jpg') }}" alt="" class="item-image">
                                </div>
                            </div>
                            <div class="text-sm md:text-base col-span-9 flex flex-col">
                                <div class="flex flex-col">
                                    <p>Alexander Arifandi</p>
                                    <div>
                                        <i class='bx bxs-star text-yellow-500'></i>
                                        <i class='bx bxs-star text-yellow-500'></i>
                                        <i class='bx bxs-star text-yellow-500'></i>
                                        <i class='bx bxs-star text-yellow-500'></i>
                                        <i class='bx bxs-star text-yellow-500'></i>
                                    </div>
                                </div>
                                <div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe corrupti doloribus
                                        sit hic sunt asperiores architecto alias cumque, dicta voluptates!</p>
                                </div>
                            </div>
                        </div>
                        <!-- END PER USER ULASAN -->
                    @endfor

                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="modal micromodal-slide" id="add-keranjang" aria-hidden="true">
        <div class="modal__overlay" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="add-keranjang-title">
                <header class="modal__header mb-8">
                    <h2 class="modal__title text-center" id="add-keranjang-title">
                        Barang berhasil ditambahkan ke keranjang
                    </h2>
                </header>
                <main class="modal__content" id="add-keranjang-content">
                    <div class="grid grid-cols-12">
                        <div class="col-span-6">
                            <div class="item-image-container-responsive bg-gray-600 rounded-2xl"
                                style="margin: 0 auto !important;">
                                {{-- ======== TODO ::: ADD IMAGE BERDASARKAN BARANG SEKARANG ======== --}}
                                <img src="{{ asset('images/IMG_7800.jpg') }}" alt="" class="item-image">
                            </div>
                        </div>
                        <div class="text-sm md:text-base font-bold col-span-6 flex flex-col justify-center">
                            <p>Shibori Tie Dye</p>
                        </div>
                    </div>
                </main>
                <footer class="flex justify-end">
                    <button type="button"
                        class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-full px-4 py-1"
                        data-micromodal-close>Kembali</button>
                </footer>
            </div>
        </div>
</x-layout>
