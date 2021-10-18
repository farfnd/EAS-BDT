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
      @include('panels.navbar')
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
            <div class="swiper-wrapper rounded-md">
              <!-- 
              //// PENTING PASTIKAN PAKE YG PALING AWAL INI KALO DALEM LOOP, SISANYA CUMAN PELENGKAP
               -->
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-blue-500 text-white rounded-bl-md rounded-tr-md">
                        Men
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-yellow-500 text-white rounded-bl-md rounded-tr-md">
                        Kids
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-red-400 text-white rounded-bl-md rounded-tr-md">
                        Women
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-blue-500 text-white rounded-bl-md rounded-tr-md">
                        Men
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-yellow-500 text-white rounded-bl-md rounded-tr-md">
                        Kids
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-red-400 text-white rounded-bl-md rounded-tr-md">
                        Women
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-blue-500 text-white rounded-bl-md rounded-tr-md">
                        Men
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-yellow-500 text-white rounded-bl-md rounded-tr-md">
                        Kids
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-red-400 text-white rounded-bl-md rounded-tr-md">
                        Women
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
            </div>
          </div>
        </div>
  
        

        <div class="min-w-full max-w-full">
          <h2 class="text-xl font-semibold mb-2">Erki Sang Buchin</h2>
          <div class="flex flex-row horizontal-scroll-swiper overflow-hidden">
            <div class="swiper-wrapper rounded-md">
              <!-- 
              //// PENTING PASTIKAN PAKE YG PALING AWAL INI KALO DALEM LOOP, SISANYA CUMAN PELENGKAP
               -->
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-blue-500 text-white rounded-bl-md rounded-tr-md">
                        Men
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-yellow-500 text-white rounded-bl-md rounded-tr-md">
                        Kids
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-red-400 text-white rounded-bl-md rounded-tr-md">
                        Women
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-blue-500 text-white rounded-bl-md rounded-tr-md">
                        Men
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-yellow-500 text-white rounded-bl-md rounded-tr-md">
                        Kids
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-red-400 text-white rounded-bl-md rounded-tr-md">
                        Women
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-blue-500 text-white rounded-bl-md rounded-tr-md">
                        Men
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-yellow-500 text-white rounded-bl-md rounded-tr-md">
                        Kids
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              
              <div class="swiper-slide max-w-2xs">
                <a href="" class="hover:bg-opacity-10 group">
                  <div class="bg-gray-100 mx-2 rounded-md shadow-md mb-8">
                    <div class="relative rounded-md shadow-md group-hover:opacity-90" style='height: 240px; width: 240px; background-size: cover; background-image: url({{asset("images/IMG_7800.jpg")}});'>
                      <div class="absolute py-1 px-4 tracking-wider text-sm bottom-0 left-0 bg-red-400 text-white rounded-bl-md rounded-tr-md">
                        Women
                      </div>
                    </div>
                    <div class="right-0 p-2 rounded-md bg-opacity-75">
                      <div class="flex flex-row items-center">
                        <div>
                          <h3 class="text-sm leading-4 mb-2">Baju Renang ni</h3>
                          <p class="text-xs font-semibold">Rp. 2.000.000.000</p>
                        </div>
                        <a onclick="test()" class=" ml-auto text-xl text-gray-600 hover:text-red-600">
                          <i class='bx bxs-heart'></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
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
