<x-layout titlePage="Hanaka | Home">

    <div class="relative flex flex-col pt-0 md:pt-4 space-y-4">
        {{-- swiper --}}
        <div class="swiper min-h-1/2vh">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper text-3xl min-h-full">
                <!-- Slides -->
                <x-home.swiper image="images/slide1.png" text="NEW ARRIVALS" />
                <x-home.swiper image="images/slide2.png" text="NEW STYLES" />
                <x-home.swiper image="images/slide3.png" text="NEW COLLECTIONS" />
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev hidden lg:visible"><i
                    class='text-4xl text-white hover:text-blue-500 bx bx-chevron-left-circle'></i></div>
            <div class="swiper-button-next hidden lg:visible"><i
                    class='text-4xl text-white hover:text-blue-500 bx bx-chevron-right-circle'></i></div>
        </div>

        <div class="mx-4 md:mx-0 max-w-full">

            {{-- items list 1 --}}
            <div class="min-w-full">
                <h2 class="text-xl font-semibold mb-2">New Stuff n' Things</h2>
                <div class="flex flex-row horizontal-scroll-swiper overflow-hidden">
                    <div class="swiper-wrapper rounded-md">
                        @foreach ($latestBarangAll as $barang)
                            @if ($barang->gender == 0)
                                <x-home.card
                                gender="men"
                                namaBarang="{{$barang->nama}}"
                                hargaBarang="{{number_format($barang->harga*1000,2,',','.')}}"
                                photo="{{route('show_product_image', $barang->foto)}}"
                                link="item/{{$barang->id}}" />
                            @elseif ($barang->gender == 1)
                                <x-home.card
                                gender="women"
                                namaBarang="{{$barang->nama}}"
                                hargaBarang="{{number_format($barang->harga*1000,2,',','.')}}"
                                photo="{{route('show_product_image', $barang->foto)}}"
                                link="item/{{$barang->id}}" />
                            @else
                                <x-home.card
                                gender="unisex"
                                namaBarang="{{$barang->nama}}"
                                hargaBarang="{{number_format($barang->harga*1000,2,',','.')}}"
                                photo="{{route('show_product_image', $barang->foto)}}"
                                link="item/{{$barang->id}}" />
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
