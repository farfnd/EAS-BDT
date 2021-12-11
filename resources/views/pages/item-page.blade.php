<x-layout titlePage="Hanaka | Items">
    <div class="grid grid-cols-1 sm:grid-cols-2">
        {{-- image section --}}
        <div>
            <div class="item-image-container-responsive bg-cover bg-center md:item-image-container-fixed bg-yellow-100 rounded-lg" style="background-image: url({{route('show_product_image', $barang->foto)}})">
            </div>
            <div class="flex flex-row px-8 space-x-2 text-sm md:text-base">
                <a href=""
                    class="flex flex-grow justify-center items-center shadow-md text-center p-2 rounded-lg border-2 border-gray-700 hover:opacity-80" id="directBuy-btn" data-id="{{$barang->id}}">
                    <div>Beli Langsung</div>
                </a>
                <a data-micromodal-trigger="add-keranjang"
                    class="cursor-pointer flex flex-grow justify-center items-center shadow-md bg-gray-700 text-white text-center p-2 rounded-lg border-2 border-gray-700 hover:opacity-80">
                    <div class="flex justify-center items-center" id="addToCart-btn" data-id="{{$barang->id}}"><i class='bx bx-plus'></i>&nbsp;Masukkan Keranjang
                    </div>
                </a>
            </div>
        </div>
        {{-- detail section --}}
        <div class="bg-gray-50 rounded-lg mt-4 ml-4 sm:ml-0 mr-4 sm:mr-8 p-4">
            <div>
                <h2 class="text-base md:text-lg font-semibold">{{$barang->nama}}</h2>
                <h5 class="text-base md:text-lg">Rp{{number_format($barang->harga*1000,2,',','.')}}</h5>
                <h5 class="text-base md:text-lg mt-2 font-semibold">Deskripsi Barang</h5>
                <p class="text-sm md:text-base pl-4">{{$barang->deskripsi}}</p>
            </div>
            <div class="mt-4">
                <h2 class="text-base md:text-lg font-semibold">Ulasan</h2>
                <div class="flex flex-col space-y-4 pt-2">
                    @if ($barang->ulasan->count())
                        @foreach ($barang->ulasan as $ulasan)
                            <!-- START PER USER ULASAN -->
                            <div class="grid grid-cols-12">
                                <div class="col-span-3">
                                    <div class="item-image-container-responsive bg-gray-600 rounded-full"
                                        style="margin: 0 auto !important;">
                                        {{-- ======== TODO ::: ADD IMAGE USER BERDASARKAN USER IMAGE ======== --}}
                                        @if ($ulasan->file_ulasan)
                                        <img src="{{route('show_review_image', $ulasan->file_ulasan)}}" alt="" class="item-image">
                                        @else
                                        <img src="{{route('show_product_image', $barang->foto)}}" alt="" class="item-image">
                                        @endif
                                    </div>
                                </div>
                                <div class="text-sm md:text-base col-span-9 flex flex-col">
                                    <div class="flex flex-col">
                                        <p>{{$ulasan->user->nama}}</p>
                                        <div>
                                            @for ($i = 0; $i < $ulasan->rating; $i++)
                                                <i class='bx bxs-star text-yellow-500'></i>
                                            @endfor
                                            @for ($i = 0; $i < 5-$ulasan->rating; $i++)
                                                <i class='bx bx-star text-yellow-500'></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <p>{{$ulasan->ulasan}}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- END PER USER ULASAN -->
                        @endforeach
                    @else
                        <p class="text-sm md:text-base pl-4">Belum ada ulasan</p>
                    @endif
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
                                <img src="{{route('show_product_image', $barang->foto)}}" alt="" class="item-image">
                            </div>
                        </div>
                        <div class="text-sm md:text-base font-bold col-span-6 flex flex-col justify-center">
                            <p>{{$barang->nama}}</p>
                        </div>
                    </div>
                </main>
                <footer class="flex justify-end">
                    <a href="/cart" class="border-2 border-gray-700 hover:opacity-80 text-black shadow-md hover:shadow-lg rounded-full px-4 py-1">
                        Lihat Keranjang
                    </a>
                    &nbsp;
                    <button type="button"
                        class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-full px-4 py-1"
                        data-micromodal-close>Kembali</button>
                </footer>
            </div>
        </div>
</x-layout>

<script>
$('#addToCart-btn').click(function (e) { 
    var id = $(this).data('id');
    $.ajax({
        type: "post",
        url: "/api/addToCart/" + id,
		async: false,
		headers: { 'Authorization': '{{ session("Authorization") }}' }
    });
});
$('#directBuy-btn').click(function (e) { 
    var id = $(this).data('id');
    $.ajax({
        type: "post",
        url: "/api/addToCart/" + id,
		async: false,
		headers: { 'Authorization': '{{ session("Authorization") }}' },
        success: location.replace("/cart")
    });
});
</script>