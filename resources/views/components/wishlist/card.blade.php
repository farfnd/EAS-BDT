<div class="bg-gray-100 rounded-md shadow-md group" id="wishlistCard-{{ $id }}">
    <a href="item/{{ $id }}">
        <div class="relative rounded-md shadow-md group-hover:opacity-90 bg-center"
            style='height: 240px; width: 100%; background-size: cover; background-image: url({{ asset("$photo") }});'>
            <div
                class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 {{ $color }} text-white rounded-bl-md rounded-tr-md capitalize">
                {{ $gender }}
            </div>
        </div>
        <div class="right-0 p-2 rounded-md bg-opacity-75">
            <div class="flex flex-row items-center">
                <div>
                    <h3 class="text-sm leading-4 mb-2">{{ $namaBarang }}</h3>
                    <p class="text-xs font-semibold">Rp{{ $hargaBarang }}</p>
                </div>
                <a onclick="test()"
                    class="ml-auto text-xl text-red-600 hover:text-gray-600 cursor-pointer z-10 wishlist-btn"
                    data-id="{{ $id }}">
                    <i class='bx bxs-heart'></i>
                </a>
            </div>
        </div>
        <div class="text-center">
            @if ($star)
                @for ($i = 0; $i < 5; $i++)
                    @if ($i < $star)
                        <i class='bx bxs-star text-yellow-500'></i>
                    @else
                        <i class='bx bx-star text-yellow-500'></i>
                    @endif
                @endfor
            @else
                <p>Tidak ada rating</p>
            @endif
        </div>
    </a>
    <div class="flex justify-center items-center py-3">
        <button class="w-3/5 bg-gray-800 hover:bg-opacity-90 rounded-lg px-1 py-1">

            <a href="{{ route('cart') }}" onclick="addtoCart({{ $id }})"
                class="text-white text-center text-sm">Tambah ke Keranjang</a>
        </button>
    </div>
</div>

<script>
    function addtoCart(id) {
        console.log(id)
        $.ajax({
            type: "post",
            url: "/api/addToCart/" + id,
            async: false,
            headers: {
                'Authorization': '{{ session('Authorization') }}'
            },
            data: {
                _token: "{{ csrf_token() }}"
            },
        }).always(data => console.log(data))
    }
</script>
