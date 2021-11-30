<div class="w-full bg-gray-50 shadow-md sticky top-0 z-50">
  <div class="flex justify items-center px-2 h-14 mb-0 md:mb-2 relative" x-data="{ profile: false }">
    {{-- logo --}}
    <div class="relative">
      <a class="absolute top-0 left-0 right-0 bottom-0" href="/"></a>
      <h1 class="font-arial font-semibold text-1xl md:text-2xl">HANAKA &amp; CO.</h2>
      <!-- <img style="height: 25px" src="{{ asset('images/logo1.png') }}" alt=""> -->
    </div>
  
    {{-- navlinks --}}
    <nav class="ml-auto align-bottom justify-center">
      <ul class="flex flex-row space-x-4 h-full text-sm md:text-base">
        <li class="block my-auto font-semibold"><a href="{{ route('category') }}" class="hover:opacity-80">Men</a></li>
        <li class="block my-auto font-semibold"><a href="{{ route('category') }}" class="hover:opacity-80">Women</a></li>
        <li class="block my-auto font-semibold"><a href="{{ route('category') }}" class="hover:opacity-80">Kids</a></li>
        <!-- IF LOGIN -->
        <li class="block my-auto font-semibold"><a href="{{ route('cart') }}" class="flex flex-row justify-center items-center hover:opacity-80"><i class='bx bx-cart bx-sm'></i></a></li>
        <li class="block my-auto font-semibold">
          <button 
            x-on:click="profile = !profile"
            class="flex flex-row justify-center items-center hover:opacity-80"
          >
            <i class='bx bx-user bx-sm bg'></i>
          </button>
        </li>
        <!-- ELSE IF NOT LOGGED IN -->
        {{-- <li class="block my-auto"><a href="" class="px-2 py-1 rounded-lg flex flex-row justify-center items-center text-white bg-gray-700 hover:opacity-80">Masuk</a></li> --}}
      </ul>
    </nav>
  
    {{-- popup user menu  --}}
    <div class="absolute top-16 right-0 z-10 bg-gray-50 p-2 rounded space-y-2 shadow-lg"
      x-show="profile" x-on:click.outside="profile = false" x-transition
      >
        <div class="flex bg-gray-200 p-1 items-center space-x-2 rounded">
        <div class="bg-gray-300 rounded-full flex items-center p-1 ">
          <i class='bx bx-user bx-sm'></i>
        </div>
        <div>
          <span>Michael Alexander</span>
        </div>
      </div>
      <ul class="space-y-1 ">
        <li class="flex w-full rounded-md hover:bg-gray-900 hover:text-white">
          <a class="flex-grow text-center py-1" href="{{ route('transaction') }}">Transaksi</a>
        </li>
        <li class="flex w-full rounded-md hover:bg-gray-900 hover:text-white">
          <a class="flex-grow text-center py-1" href="{{ route('historyTransaction') }}">Riwayat</a>
        </li>
        <li class="flex w-full rounded-md hover:bg-gray-900 hover:text-white">
          <a class="flex-grow text-center py-1" href="/wishlist">Wishlist</a>
        </li>
        <li class="flex bg-red-600 text-white w-full rounded-md hover:bg-red-800 ">
          <a class="flex-grow text-center py-1" href="">Sign Out</a>
        </li>
      </ul>
    </div>
  </div>
</div>