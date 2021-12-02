@php
use Illuminate\Support\Facades\Auth;
@endphp

<div id="navbar-admin" class="w-full bg-gray-50 shadow-md sticky top-0 z-50 px-4">
  <div class="flex justify items-center px-2 h-14 relative">
    {{-- logo --}}
    <div class="relative">
      <a class="absolute top-0 left-0 right-0 bottom-0" href="/"></a>
      <h1 class="font-arial font-semibold text-1xl md:text-2xl">HANAKA &amp; CO.</h2>
        <!-- <img style="height: 25px" src="{{ asset('images/logo1.png') }}" alt=""> -->
    </div>

    {{-- ======== START ::: INFO ======== --}}
    <nav class="flex space-x-4 ml-auto items-center justify-center">
      <p>Jumat, 19 Desember 2021</p>
      <div class="flex justify-center items-center bg-gray-200 rounded-full w-8 h-8"><i class='bx bx-cog'></i></div>
      <div class="flex justify-center items-center bg-gray-200 rounded-full w-8 h-8"><i class='bx bx-user'></i></div>
    </nav>
    {{-- ======== END ::: INFO ======== --}}

  </div>
</div>
