@php
use Illuminate\Support\Facades\Auth;
@endphp

<div class="w-full bg-gray-50 shadow-md sticky top-0 z-50" x-data="{ loginDropdown: false }">
    <div class="flex justify items-center px-2 h-14 mb-0 md:mb-2 relative" x-data="{ profile: false }">
        {{-- logo --}}
        <div class="relative">
            <a class="absolute top-0 left-0 right-0 bottom-0" href="/"></a>
            <h1 class="font-arial font-semibold text-1xl md:text-2xl">HANAKA &amp; CO.</h2>
                <!-- <img style="height: 25px" src="{{ asset('images/logo1.png') }}" alt=""> -->
        </div>

        {{-- ======== START ::: NAVIGATION LINKS ======== --}}
        <nav class="ml-auto align-bottom justify-center">
            <ul class="flex flex-row space-x-6 h-full text-sm md:text-base">
                <li class="block my-auto font-semibold"><a href="{{ route('category', 0) }}"
                        class="hover:opacity-80">Men</a></li>
                <li class="block my-auto font-semibold"><a href="{{ route('category', 1) }}"
                        class="hover:opacity-80">Women</a></li>
                <li class="block my-auto font-semibold"><a href="{{ route('category', 2) }}"
                        class="hover:opacity-80 mr-5">Unisex</a></li>
                @if (Auth::check())
                    <li class="block my-auto font-semibold"><a href="{{ route('cart') }}"
                            class="flex flex-row justify-center items-center hover:opacity-80"><i
                                class='bx bx-cart bx-sm'></i></a>
                    </li>
                    <li class="block my-auto font-semibold">
                        <button x-on:click="profile = !profile"
                            class="flex flex-row justify-center items-center hover:opacity-80">
                            <i class='bx bx-user bx-sm bg'></i>
                        </button>
                    </li>
                @else
                    <li class="block my-auto">
                        <button data-micromodal-trigger="register-user"
                            class="cursor-pointer px-2 py-1 rounded-lg flex flex-row justify-center items-center text-white bg-gray-700 hover:opacity-80">
                            Daftar
                        </button>
                    </li>
                    <li class="block my-auto">
                        <button x-on:click="loginDropdown = !loginDropdown"
                            class="cursor-pointer px-2 py-1 rounded-lg flex flex-row justify-center items-center text-white bg-gray-700 hover:opacity-80">
                            Masuk
                        </button>
                    </li>
                @endif
            </ul>
        </nav>
        {{-- ======== END ::: NAVIGATION LINKS ======== --}}

        {{-- ========================================================================
        START ::: USER DROPDOWN NOT LOGGED IN
    ======================================================================== --}}
        <div class="absolute top-16 right-0 z-10 bg-white p-4 rounded space-y-2 shadow-lg" x-show="loginDropdown"
            x-on:click.outside="loginDropdown = false" x-transition>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                            role="alert">
                            <strong class="font-bold">{{ $errors->first() }}</strong>
                            {{-- <strong class="font-bold">Test</strong> --}}
                        </div>
                    @endif

                    <label class="block">
                        <span class="text-gray-900">Username/Email</span>
                        <input type="text"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Username/Email" name="username" required maxlength="100">
                    </label>
                    <label class="block">
                        <span class="text-gray-900">Password</span>
                        <input type="password"
                            class="mt-1   block   w-full   rounded-md   border-gray-300   shadow-sm   focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Password" name="password" id="loginPassword" required minlength="8"
                            maxlength="50">
                    </label>
                    <div class="flex gap-4 justify-between items-center">
                        <p>
                            Belum punya akun?
                            <a class="cursor-pointer font-bold" onclick="showModal('register-user')">Daftar</a>
                        </p>
                        <button class="bg-gray-800 text-white py-2 px-3 rounded-lg" type="submit"
                            id="loginButton">Login</button>
                    </div>
                </div>
            </form>
        </div>
        {{-- ========================================================================
        END ::: USER DROPDOWN NOT LOGGED IN
    ======================================================================== --}}

        {{-- ========================================================================
        START ::: USER DROPDOWN IS LOGGED IN
    ======================================================================== --}}
        @if (Auth::check())
            <div class="absolute top-16 right-0 z-10 bg-gray-50 p-2 rounded space-y-2 shadow-lg w-52" x-show="profile"
                x-on:click.outside="profile = false" x-transition>
                <div class="flex bg-gray-200 p-1 items-center justify-center space-x-2 rounded">
                    <div class="bg-gray-300 rounded-full flex items-center p-1 ">
                        <i class='bx bx-user bx-sm'></i>
                    </div>
                    <div>
                        <span>{{ Auth::user()->nama }}</span>
                    </div>
                </div>
                <ul class="space-y-1 ">
                    @if (Auth::user()->isAdmin)
                        <li class="flex w-full rounded-md hover:bg-gray-900 hover:text-white">
                            <a class="flex-grow text-center py-1" href="{{ route('admin.barang') }}">Dashboard
                                Admin</a>
                        </li>
                    @endif
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
                        <a class="flex-grow text-center py-1" href="/logout">Sign Out</a>
                    </li>
                </ul>
            </div>
        @endif
        {{-- ========================================================================
        END ::: USER DROPDOWN IS LOGGED IN
    ======================================================================== --}}

        {{-- ======== START ::: REGISTER MODAL ======== --}}
        <div class="modal micromodal-slide" id="register-user" aria-hidden="true">
            <div class="modal__overlay" data-micromodal-close>
                <div class="modal__container max-w-5xl w-12/12 md:w-6/12" role="dialog" aria-modal="true"
                    aria-labelledby="register-user-title">
                    <header class="modal__header w-max">
                        <h2 class="modal__title text-center" id="register-user-title">
                            Daftar Akun
                        </h2>
                    </header>
                    <main class="modal__content w-full mt-8" id="register-user-content">
                        <div class="grid grid-cols-12">
                            <div class="col-span-12">
                                <form action="{{ route('register.create') }}" method="post">
                                    @csrf
                                    <div class="grid grid-cols-1 gap-6">
                                        <label class="block">
                                            <span class="text-gray-700">Nama</span>
                                            <input type="text"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                placeholder="Nama" name="nama" required maxlength="100">
                                        </label>
                                        <label class="block">
                                            <span class="text-gray-700">Username</span>
                                            <input type="text"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                placeholder="Username" name="username" required minlength="3"
                                                maxlength="25">
                                        </label>
                                        <label class="block">
                                            <span class="text-gray-700">Email</span>
                                            <input type="email"
                                                class=" mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                placeholder="john@example.com" name="email" required maxlength="100">
                                        </label>
                                        <label class="block">
                                            <span class="text-gray-700">Nomor Telepon</span>
                                            <input type="tel"
                                                class=" mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                placeholder="081234567890" name="no_telepon" required
                                                pattern="(08)[0-9]{8,12}" minlength="10" maxlength="14">
                                        </label>
                                        <label class="block">
                                            <span class="text-gray-700">Password</span>
                                            <input type="password"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                placeholder="Password" name="password" id="password" required
                                                minlength="8" maxlength="50">
                                        </label>
                                        <label class="block">
                                            <span class="text-gray-700">Konfirmasi Password</span>
                                            <input type="password"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                placeholder="Konfirmasi Password" name="confirmPassword"
                                                id="confirmPassword" required oninput="checkPassword()" minlength="8"
                                                maxlength="50">
                                        </label>
                                        <p class="text-red-500" id="confirmPasswordWarning" style="display: none;">
                                            Kata sandi konfirmasi
                                            tidak
                                            cocok!</p>
                                        <button type="submit" id="registerButton">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        {{-- ======== END ::: REGISTER MODAL ======== --}}

    </div>
</div>
<script>
    const checkPassword = () => {
        console.log($("#password").val())
        console.log($("#confirmPassword").val())
        if ($("#confirmPassword").val() !== $("#password").val()) {
            $('#confirmPasswordWarning').show();
            $("#loginButton").prop('disabled', true);
            $("#registerButton").prop('disabled', true);
        } else {
            $('#confirmPasswordWarning').hide();
            $("#loginButton").prop('disabled', false);
            $("#registerButton").prop('disabled', false);
        }
    }


    const showModal = (id) => {
        MicroModal.show(id);
    }
</script>
