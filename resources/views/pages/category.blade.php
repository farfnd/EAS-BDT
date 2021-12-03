<x-layout titlePage="Hanaka | Wishlist">
    <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">Men Section</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-5 gap-y-5 mx-8 mt-8 mb-6">
        @for ($i = 0; $i < 6; $i++)
            <x-wishlist.card gender="men" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"
                link="./item" star="3" />
        @endfor
    </div>
</x-layout>
