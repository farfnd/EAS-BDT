<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Hanaka Classic</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>
	
    <style>
      .swiper {
        width: 100%;
      }
      .swiper-button-prev:after, .swiper-rtl .swiper-button-next:after {
          content: '';
      }
      .swiper-button-next:after, .swiper-rtl .swiper-button-next:after {
          content: '';
      }
      .horizontal-scroll-swiper {
        width: 100%;
      }
    </style>  
  </head>
  <body class="antialiased lg:mx-auto font-poppins max-w-7xl">
    <div class="mx-8">
      <x-navbar></x-navbar>
	  
      <div class="relative flex flex-col sm:items-center py-4 sm:pt-0 space-y-4">

        <div class="swiper min-h-1/4vh md:min-h-1/2vh">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper text-3xl min-h-full">
            <!-- Slides -->
            <div class="swiper-slide flex justify-center bg-blue-100 min-h-1/4vh md:min-h-1/2vh">Slide 1</div>
            <div class="swiper-slide flex justify-center bg-blue-100 min-h-1/4vh md:min-h-1/2vh">Slide 2</div>
            <div class="swiper-slide flex justify-center bg-blue-100 min-h-1/4vh md:min-h-1/2vh">Slide 3</div>
          </div>
          <!-- If we need pagination -->
          <div class="swiper-pagination"></div>
  
          <!-- If we need navigation buttons -->
          <div class="swiper-button-prev hidden lg:visible"><i class='text-4xl text-gray-800 hover:text-blue-500 bx bx-chevron-left-circle'></i></div>
          <div class="swiper-button-next hidden lg:visible"><i class='text-4xl text-gray-800 hover:text-blue-500 bx bx-chevron-right-circle'></i></div>
  
          <!-- If we need scrollbar -->
          <!-- <div class="swiper-scrollbar"></div> -->
        </div>

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

        <div class="min-w-full max-w-full">
          <h2 class="text-xl font-semibold mb-2">ANANDA BABIK</h2>
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
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
	<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>  
    <script>
      const swiper = new Swiper('.swiper', {
        // Optional parameters
        direction: 'horizontal',
        loop: true,

        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        },

        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });
      let swiper2 = new Swiper('.horizontal-scroll-swiper', {
        slidesPerView: "auto",
        freeMode: true
      })

      const test = () => {
        console.log("YAMET KUDASHIII!!!");
      }
    </script>
  </body>
</html>
