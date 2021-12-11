<div class="swiper-slide max-w-3xs md:max-w-2xs mx-2">
    <div class="relative bg-gray-100 rounded-md shadow-md mb-8 group">
        <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 100%; background-size: cover; background-image: url({{ asset("$photo") }});'>
            <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 {{$color}} text-white rounded-bl-md rounded-tr-md capitalize">
                {{ $gender }}
            </div>
        </div>
        <div class="right-0 p-2 rounded-md bg-opacity-75">
            <div class="flex flex-row items-center">
                <div>
                    <h3 class="text-sm leading-4 mb-2">{{ $namaBarang }}</h3>
                    <p class="text-xs font-semibold">Rp{{ $hargaBarang }}</p>
                </div>
                <a onclick="test()" class="ml-auto text-xl text-gray-600 hover:text-red-600 cursor-pointer z-10">
                    <i class='bx bxs-heart wishlist-btn' data-id="{{$id}}"></i>
                </a>
            </div>
        </div>
        <a href="item/{{ $id }}" class="absolute top-0 right-0 bottom-0 left-0 z-0">
        </a>
    </div>
</div>