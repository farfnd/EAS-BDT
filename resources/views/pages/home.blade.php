<x-layout titlePage="Hanaka | Home">
  <div class="mx-8">
    <x-navbar></x-navbar>
  
    <div class="relative flex flex-col sm:items-center py-4 sm:pt-0 space-y-4">
      {{-- swiper --}}
      <div class="swiper min-h-1/4vh md:min-h-1/2vh">
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
        <div class="swiper-button-prev hidden lg:visible"><i class='text-4xl text-gray-800 hover:text-blue-500 bx bx-chevron-left-circle'></i></div>
        <div class="swiper-button-next hidden lg:visible"><i class='text-4xl text-gray-800 hover:text-blue-500 bx bx-chevron-right-circle'></i></div>
      </div>
      
      {{-- items list 1 --}}
      <div class="min-w-full max-w-full">
        <h2 class="text-xl font-semibold mb-2">New Stuff n' Things</h2> 
        <div class="flex flex-row horizontal-scroll-swiper overflow-hidden">
          <div class="swiper-wrapper space-x-4 rounded-md">
            <!-- 
            //// PENTING PASTIKAN PAKE YG PALING AWAL INI KALO DALEM LOOP, SISANYA CUMAN PELENGKAP
             -->
            @for ($i = 0; $i < 3; $i++)
              <x-home.card gender="men" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"/>
              <x-home.card gender="women" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"/>
              <x-home.card gender="kids" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"/>
            @endfor
          </div>
        </div>
      </div>
      
      {{-- items list 2 --}}
      <div class="min-w-full max-w-full">
        <h2 class="text-xl font-semibold mb-2">ANANDA PUNYA</h2>
        <div class="flex flex-row horizontal-scroll-swiper overflow-hidden">
          <div class="swiper-wrapper space-x-4 rounded-md">
            <!-- 
            //// PENTING PASTIKAN PAKE YG PALING AWAL INI KALO DALEM LOOP, SISANYA CUMAN PELENGKAP
             -->
            @for ($i = 0; $i < 3; $i++)
              <x-home.card gender="men" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"/>
              <x-home.card gender="women" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"/>
              <x-home.card gender="kids" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"/>
            @endfor
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>
