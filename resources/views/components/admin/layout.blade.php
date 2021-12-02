<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  {{-- ======== FONTS ======== --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  {{-- ======== CSS ======== --}}
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  {{-- ======== JS ======== --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
  </script>
  <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>

  <style>
    .swiper {
      width: 100%;
    }

    .swiper-button-prev:after,
    .swiper-rtl .swiper-button-next:after {
      content: '';
    }

    .swiper-button-next:after,
    .swiper-rtl .swiper-button-next:after {
      content: '';
    }

    .horizontal-scroll-swiper {
      width: 100%;
    }

  </style>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="antialiased lg:mx-auto font-poppins max-w-7xl">

  <x-admin.navbar></x-admin.navbar>
  <div class="relative grid grid-cols-12">
    <div class="col-span-3 mr-4">
      <div id="sidebar" class="shadow-lg sticky space-y-2 px-2">
        <div onclick="test()"
          class="bg-gray-100 hover:bg-gray-50 p-4 text-center hover:shadow-md rounded-md duration-100 cursor-pointer">
          Add
        </div>
        <div onclick="test()"
          class="bg-gray-100 hover:bg-gray-50 p-4 text-center hover:shadow-md rounded-md duration-100 cursor-pointer">
          Transactions</div>
      </div>

    </div>
    <div class="col-span-9">
      {{ $slot }}
    </div>
  </div>

  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
    $("#sidebar").height($(window).outerHeight() - $("#navbar-admin").outerHeight())
    $("#sidebar").css("top", $("#navbar-admin").outerHeight())
    $(document).ready(() => {
      MicroModal.init({
        awaitCloseAnimation: true,
        disableFocus: true,
      });
    })
    const test = () => {
      console.log("YA YA YA MET")
    }
  </script>
</body>

</html>
