<x-layout titlePage="Hanaka | Home">
    <div class="md:mx-8">
      <x-navbar></x-navbar>
        
      <form action="{{ route('login') }}" method="post">
          @csrf
          <div class="grid grid-cols-1 gap-6">
            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{$errors->first()}}</strong>
                    {{-- <strong class="font-bold">Test</strong> --}}
                </div>
            @endif

            <label class="block">
              <span class="text-gray-700">Username/Email</span>
              <input type="text" class="
                  mt-1
                  block
                  w-full
                  rounded-md
                  border-gray-300
                  shadow-sm
                  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                " placeholder="Username/Email" name="username" id="username" required maxlength="100">
            </label>
            <label class="block">
                <span class="text-gray-700">Password</span>
                <input type="password" class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                " name="password" id="password" required minlength="8" maxlength="50">
            </label>
          <button type="submit" id="formButton">Submit</button>
      </form>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
  </x-layout>
  