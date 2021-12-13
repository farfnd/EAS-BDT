<x-layout titlePage="Hanaka | {{$id == 0 ? 'For Men' : ($id==1 ? 'For Women' : ($id==2 ? 'Unisex Products' : ''))}}">
    <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">{{$id == 0 ? "Men"."'s" : ($id==1 ? "Women"."'s" : ($id==2 ? 'Unisex' : ''))}} Section</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-5 gap-y-5 mx-8 mt-8 mb-6">
        @foreach ($barangAll as $barang)
            @if ($barang->gender == 0)
                <x-home.card
                    gender="men"
                    namaBarang="{{$barang->nama}}"
                    hargaBarang="{{number_format($barang->harga*1000,0,',','.')}}"
                    photo="{{route('show_product_image', $barang->foto)}}"
                    id="{{$barang->id}}"
                    inWishlist="{{$barang->inWishlist}}" />
            @elseif ($barang->gender == 1)
                <x-home.card
                gender="women"
                namaBarang="{{$barang->nama}}"
                hargaBarang="{{number_format($barang->harga*1000,0,',','.')}}"
                photo="{{route('show_product_image', $barang->foto)}}"
                id="{{$barang->id}}"
                inWishlist="{{$barang->inWishlist}}" />
            @else
                <x-home.card
                gender="unisex"
                namaBarang="{{$barang->nama}}"
                hargaBarang="{{number_format($barang->harga*1000,0,',','.')}}"
                photo="{{route('show_product_image', $barang->foto)}}"
                id="{{$barang->id}}"
                inWishlist="{{$barang->inWishlist}}" />
            @endif
        @endforeach
    </div>
</x-layout>

<script>
    $('.wishlist-btn').click(function (e) {
        var button = $(this); 
        var id = button.data('id');
        if (button.hasClass('hover:text-red-600')){
            $.ajax({
                type: "post",
                url: "/api/addToWishlist/" + id,
                headers: { 'Authorization': '{{ session('Authorization') }}' },
                data: { _token: "{{ csrf_token() }}", },
                success: function (response) {
                    let timerInterval
                    toastr["success"]("", "Barang berhasil ditambahkan ke wishlist!")
                    button.removeClass(['text-gray-600', 'hover:text-red-600']).addClass([
                        'text-red-600', 'hover:text-gray-600'
                    ]);
                }
            });
        }
        else if (button.hasClass('hover:text-gray-600')){
            $.ajax({
                type: "post",
                url: "/api/deleteFromWishlist/" + id,
                headers: { 'Authorization': '{{ session('Authorization') }}' },
                data: { _token: "{{ csrf_token() }}", },
                success: function (response) {
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