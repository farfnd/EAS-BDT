<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <title>{{ $titlePage }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css'>
  <link rel='stylesheet' href='https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css'>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous">
  </script>
  <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  
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

  {{ $slot }}

  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script>
    $(document).ready(() => {
      MicroModal.init({
        awaitCloseAnimation: true,
        disableFocus: true,
      });
    })

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
