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
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">

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
    <div class="mx-0 md:mx-8">
      @include('panels.navbar')
      <div class="relative grid grid-cols-1 sm:grid-cols-2">
        <div>
          <div class="item-image-container-responsive md:item-image-container-fixed bg-yellow-100 rounded-lg">
            <img src="{{asset('images/IMG_7800.jpg')}}" alt="" class="item-image">
          </div>
          <div class="flex flex-row px-8 space-x-2 text-sm md:text-base">
            <a href="" class="flex flex-grow justify-center items-center shadow-md text-center p-2 rounded-lg border-2 border-gray-700 hover:opacity-80">
              <div>Beli Langsung</div>
            </a>
            <a href="" class="flex flex-grow justify-center items-center shadow-md bg-gray-700 text-white text-center p-2 rounded-lg border-2 border-gray-700 hover:opacity-80">
              <div class="flex justify-center items-center"><i class='bx bx-plus' ></i>&nbsp;Masukkan Keranjang</div>
            </a>
          </div>
        </div>
        <div class="bg-gray-50 rounded-lg mt-4 ml-4 sm:ml-0 mr-4 sm:mr-8 p-4">
          <div>
            <h2 class="text-base md:text-lg font-semibold">Shibori Tie Dye</h2>
            <h5 class="text-base md:text-lg font-semibold">Rp. 165.000</h5>
            <h5 class="text-base md:text-lg mt-2">Deskripsi Barang</h5>
            <p class="text-sm md:text-base pl-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim hic ducimus nemo odit tempora nostrum! Odit tenetur nisi incidunt dolorum harum fugiat aliquid aliquam, porro quisquam architecto unde tempore vero eveniet libero possimus ipsa quae minima dolore culpa velit inventore perspiciatis cumque? Eum asperiores, a fugit nesciunt ratione et repudiandae.</p>
          </div>
          <div class="mt-4">
            <h2 class="text-base md:text-lg font-semibold">Ulasan</h2>
            <div class="flex flex-col space-y-4 pt-2">

              <!-- START PER USER ULASAN -->
              <div class="grid grid-cols-12">
                <div class="col-span-3">
                  <div class="item-image-container-responsive bg-gray-600 rounded-full" style="margin: 0 auto !important;">
                    <img src="{{asset('images/IMG_7800.jpg')}}" alt="" class="item-image">
                  </div>
                </div>
                <div class="text-sm md:text-base col-span-9 flex flex-col">
                  <div class="flex flex-col">
                    <p>Alexander Arifandi</p>
                    <div>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                    </div>
                  </div>
                  <div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe corrupti doloribus sit hic sunt asperiores architecto alias cumque, dicta voluptates!</p>
                  </div>
                </div>
              </div>
              <!-- END PER USER ULASAN -->
              

              <!-- START PER USER ULASAN -->
              <div class="grid grid-cols-12">
                <div class="col-span-3">
                  <div class="item-image-container-responsive bg-gray-600 rounded-full" style="margin: 0 auto !important;">
                    <img src="{{asset('images/IMG_7800.jpg')}}" alt="" class="item-image">
                  </div>
                </div>
                <div class="text-sm md:text-base col-span-9 flex flex-col">
                  <div class="flex flex-col">
                    <p>Alexander Arifandi</p>
                    <div>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                    </div>
                  </div>
                  <div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe corrupti doloribus sit hic sunt asperiores architecto alias cumque, dicta voluptates!</p>
                  </div>
                </div>
              </div>
              <!-- END PER USER ULASAN -->
              

              <!-- START PER USER ULASAN -->
              <div class="grid grid-cols-12">
                <div class="col-span-3">
                  <div class="item-image-container-responsive bg-gray-600 rounded-full" style="margin: 0 auto !important;">
                    <img src="{{asset('images/IMG_7800.jpg')}}" alt="" class="item-image">
                  </div>
                </div>
                <div class="text-sm md:text-base col-span-9 flex flex-col">
                  <div class="flex flex-col">
                    <p>Alexander Arifandi</p>
                    <div>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                      <i class='bx bxs-star text-yellow-500' ></i>
                    </div>
                  </div>
                  <div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe corrupti doloribus sit hic sunt asperiores architecto alias cumque, dicta voluptates!</p>
                  </div>
                </div>
              </div>
              <!-- END PER USER ULASAN -->
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
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
