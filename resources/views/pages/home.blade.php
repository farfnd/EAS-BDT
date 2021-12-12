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
                                <x-home.card gender="men" namaBarang="{{ $barang->nama }}"
                                    hargaBarang="{{ number_format($barang->harga * 1000, 0, ',', '.') }}"
                                    photo="{{ route('show_product_image', $barang->foto) }}" id="{{ $barang->id }}"
                                    inWishlist="{{ $barang->inWishlist }}" />
                            @elseif ($barang->gender == 1)
                                <x-home.card gender="women" namaBarang="{{ $barang->nama }}"
                                    hargaBarang="{{ number_format($barang->harga * 1000, 0, ',', '.') }}"
                                    photo="{{ route('show_product_image', $barang->foto) }}" id="{{ $barang->id }}"
                                    inWishlist="{{ $barang->inWishlist }}" />
                            @else
                                <x-home.card gender="unisex" namaBarang="{{ $barang->nama }}"
                                    hargaBarang="{{ number_format($barang->harga * 1000, 0, ',', '.') }}"
                                    photo="{{ route('show_product_image', $barang->foto) }}"
                                    id="{{ $barang->id }}" inWishlist="{{ $barang->inWishlist }}" />
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    $('.wishlist-btn').click(function(e) {
        var button = $(this);
        var id = button.data('id');
        if (button.hasClass('hover:text-red-600')) {
            $.ajax({
                type: "post",
                url: "/api/addToWishlist/" + id,
                headers: {
                    'Authorization': '{{ session('Authorization') }}'
                },
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    let timerInterval
                    toastr["success"]("", "Barang berhasil ditambahkan ke wishlist!")
                    button.removeClass(['text-gray-600', 'hover:text-red-600']).addClass([
                        'text-red-600', 'hover:text-gray-600'
                    ]);
                }
            });
        } else if (button.hasClass('hover:text-gray-600')) {
            $.ajax({
                type: "post",
                url: "/api/deleteFromWishlist/" + id,
                headers: {
                    'Authorization': '{{ session('Authorization') }}'
                },
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    let timerInterval
                    toastr["success"]("", "Barang berhasil dihapus dari wishlist!")
                    button.removeClass(['text-red-600', 'hover:text-gray-600']).addClass([
                        'text-gray-600', 'hover:text-red-600'
                    ]);
                }
            });
        }
    });
</script>
