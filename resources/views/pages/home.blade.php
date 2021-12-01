<x-layout titlePage="Hanaka | Home">
  <div class="md:mx-8">
    <x-navbar></x-navbar>

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
              <!-- 
              //// PENTING PASTIKAN PAKE YG PALING AWAL INI KALO DALEM LOOP, SISANYA CUMAN PELENGKAP
               -->
              @for ($i = 0; $i < 3; $i++)
                <x-home.card gender="men" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"
                  link="./item" />
                <x-home.card gender="women" namaBarang="Baju baru ni" hargaBarang="2.000.000"
                  photo="images/IMG_7800.jpg" link="./item" />
                <x-home.card gender="kids" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"
                  link="./item" />
              @endfor
            </div>
          </div>
        </div>

        {{-- items list 2 --}}
        <div class="min-w-full">
          <h2 class="text-xl font-semibold mb-2">ANANDA PUNYA</h2>
          <div class="flex flex-row horizontal-scroll-swiper overflow-hidden">
            <div class="swiper-wrapper rounded-md">
              <!-- 
              //// PENTING PASTIKAN PAKE YG PALING AWAL INI KALO DALEM LOOP, SISANYA CUMAN PELENGKAP
               -->
              @for ($i = 0; $i < 3; $i++)
                <x-home.card gender="men" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"
                  link="./item" />
                <x-home.card gender="women" namaBarang="Baju baru ni" hargaBarang="2.000.000"
                  photo="images/IMG_7800.jpg" link="./item" />
                <x-home.card gender="kids" namaBarang="Baju baru ni" hargaBarang="2.000.000" photo="images/IMG_7800.jpg"
                  link="./item" />
              @endfor
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-layout>
