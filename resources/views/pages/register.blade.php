<x-layout titlePage="Hanaka | Home">
    <form action="{{ route('register.create') }}" method="post">
        @csrf
        <div class="grid grid-cols-1 gap-6">
            <label class="block">
                <span class="text-gray-700">Nama</span>
                <input type="text"
                    class="
                  mt-1
                  block
                  w-full
                  rounded-md
                  border-gray-300
                  shadow-sm
                  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                "
                    placeholder="Nama" name="nama" id="nama" required maxlength="100">
            </label>
            <label class="block">
                <span class="text-gray-700">Username</span>
                <input type="text"
                    class="
                  mt-1
                  block
                  w-full
                  rounded-md
                  border-gray-300
                  shadow-sm
                  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                "
                    placeholder="Username" name="username" id="username" required minlength="3" maxlength="25">
            </label>
            <label class="block">
                <span class="text-gray-700">Email</span>
                <input type="email"
                    class="
                  mt-1
                  block
                  w-full
                  rounded-md
                  border-gray-300
                  shadow-sm
                  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                "
                    placeholder="john@example.com" name="email" id="email" required maxlength="100">
            </label>
            <label class="block">
                <span class="text-gray-700">Nomor Telepon</span>
                <input type="tel"
                    class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                "
                    placeholder="081234567890" name="no_telepon" id="no_telepon" required pattern="(08)[0-9]{8,12}"
                    minlength="10" maxlength="14">
            </label>
            <label class="block">
                <span class="text-gray-700">Password</span>
                <input type="password"
                    class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                "
                    name="password" id="password" required minlength="8" maxlength="50">
            </label>
            <label class="block">
                <span class="text-gray-700">Konfirmasi Password</span>
                <input type="password"
                    class="
                    mt-1
                    block
                    w-full
                    rounded-md
                    border-gray-300
                    shadow-sm
                    focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                "
                    name="confirmPassword" id="confirmPassword" required minlength="8" maxlength="50">
            </label>
            <p class="text-danger" id="confirmPasswordWarning" style="display: none;">Kata sandi konfirmasi tidak
                cocok!</p>
            <button type="submit" id="formButton">Submit</button>
    </form>
    <script>
        $("#confirmPassword").keyup(function(e) {
            if ($(this).val() !== $("#password").val()) {
                $('#confirmPasswordWarning').show();
                $("#formButton").prop('disabled', true);
            } else {
                $('#confirmPasswordWarning').hide();
                $("#formButton").prop('disabled', false);
            }
        });
    </script>
</x-layout>
