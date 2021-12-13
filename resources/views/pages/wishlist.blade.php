<x-layout titlePage="Hanaka | Wishlist">
    <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">Wishlist</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-5 gap-y-5 mx-8 mt-8 mb-6">
        @foreach ($wishlistAll as $wishlistItem)
            @if ($wishlistItem->barang->gender == 0)
                <x-wishlist.card
                    gender="men"
                    namaBarang="{{$wishlistItem->barang->nama}}"
                    hargaBarang="{{number_format($wishlistItem->barang->harga*1000,0,',','.')}}"
                    photo="{{route('show_product_image', $wishlistItem->barang->foto)}}"
                    id="{{$wishlistItem->barang->id}}" star="{{$wishlistItem->barang->rating}}" />
            @elseif ($wishlistItem->barang->gender == 1)
                <x-wishlist.card
                    gender="women"
                    namaBarang="{{$wishlistItem->barang->nama}}"
                    hargaBarang="{{number_format($wishlistItem->barang->harga*1000,0,',','.')}}"
                    photo="{{route('show_product_image', $wishlistItem->barang->foto)}}"
                    id="{{$wishlistItem->barang->id}}" star="{{$wishlistItem->barang->rating}}" />
            @else
                <x-wishlist.card
                    gender="unisex"
                    namaBarang="{{$wishlistItem->barang->nama}}"
                    hargaBarang="{{number_format($wishlistItem->barang->harga*1000,0,',','.')}}"
                    photo="{{route('show_product_image', $wishlistItem->barang->foto)}}"
                    id="{{$wishlistItem->barang->id}}" star="{{$wishlistItem->barang->rating}}" />
            @endif
        @endforeach
    </div>
</x-layout>

<script>
    $('.wishlist-btn').click(function (e) {
        var button = $(this); 
        var id = button.data('id');
        $.ajax({
            type: "post",
            url: "/api/deleteFromWishlist/" + id,
            headers: { 'Authorization': '{{ session('Authorization') }}' },
            data: { _token: "{{ csrf_token() }}", },
            success: function (response) {
                $(`#wishlistCard-${id}`).remove();
                let timerInterval
                toastr["success"]("", "Barang berhasil dihapus dari wishlist!")
                button.removeClass(['text-red-600', 'hover:text-gray-600']).addClass([
                    'text-gray-600', 'hover:text-red-600'
                ]);
            }
        });
    });
</script>