<x-layout titlePage="Hanaka | Wishlist">
    <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">Wishlist</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-5 gap-y-5 mx-8 mt-8 mb-6">
        @foreach ($wishlistAll as $wishlistItem)
            @if ($wishlistItem->barang->gender == 0)
            <x-wishlist.card
                gender="men"
                namaBarang="{{$wishlistItem->barang->nama}}"
                hargaBarang="2.000.000"
                photo="{{route('show_product_image', $wishlistItem->barang->foto)}}"
                id="{{$wishlistItem->barang->id}}" star="{{$wishlistItem->barang->rating}}" />
            @elseif ($wishlistItem->barang->gender == 1)
                <x-home.card
                gender="women"
                namaBarang="{{$wishlistItem->barang->nama}}"
                hargaBarang="{{number_format($wishlistItem->barang->harga*1000,2,',','.')}}"
                photo="{{route('show_product_image', $wishlistItem->barang->foto)}}"
                id="{{$wishlistItem->barang->id}}" star="{{$wishlistItem->barang->rating}}" />
            @else
                <x-home.card
                    gender="unisex"
                    namaBarang="{{$wishlistItem->barang->nama}}"
                    hargaBarang="{{number_format($wishlistItem->barang->harga*1000,2,',','.')}}"
                    photo="{{route('show_product_image', $wishlistItem->barang->foto)}}"
                    id="{{$wishlistItem->barang->id}}" star="{{$wishlistItem->barang->rating}}" />
            @endif
        @endforeach
    </div>
</x-layout>
