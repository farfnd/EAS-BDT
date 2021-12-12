@php
$data = session()->get('data');
$totalHarga = 0;
@endphp

<x-layout titlePage="Hanaka | Cart">
    {{-- ======== PAGE IMPORTS ======== --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">Checkout Pesanan</h2>
    <div class="grid grid-cols-8 gap-x-8 mx-8 mt-4 my-6">
        {{-- form section --}}
        <div class="col-span-8 lg:col-span-5 shadow-custom1 px-5 py-4 rounded-lg">
            <form action="" method="POST">
                <div class="flex flex-col space-y-3">
                    <div class="flex flex-col space-y-1">
                        <label for="nama" class="col-span-3">Nama Penerima</label>
                        <input type="text"
                            class="col-span-9 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Erki Khadafi Rosyid" name="" id="nama" required maxlength="100">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="alamat" class="col-span-3">Alamat</label>
                        <input type="text"
                            class="col-span-9 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Jl. Paguyuban II, No.14" name="" id="alamat" required maxlength="100">
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="provinsi">Provinsi</label>
                        <select class="select2-data-array browser-default" id="select2-provinsi"></select>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="kota_kab">Kota/Kabupaten</label>
                        <select class="select2-basic select2-data-array browser-default" id="select2-kabupaten">
                            <option value="">{{ 'Pilih Provinsi' }}</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="kecamatan">Kecamatan</label>
                        <select class="select2-basic select2-data-array browser-default" id="select2-kecamatan">
                            <option value="">{{ 'Pilih Provinsi' }}</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-12 gap-10">
                        <div class="col-span-3 flex flex-col space-y-1">
                            <label for="kode_pos" class="col-span-3">Kode Pos</label>
                            <input type="text"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="17115" name="" id="kode_pos" required maxlength="100">
                        </div>
                        <div class="col-span-9 flex flex-col space-y-1">
                            <label for="no_telp" class="col-span-3">Nomor Telepon</label>
                            <div class="flex">
                                <span
                                    class="flex items-center bg-grey-lighter rounded rounded-r-none border border-r-0 border-gray-300 px-3 text-grey-dark text-sm">+62</span>
                                <input type="text"
                                    class="w-full border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    placeholder="81234567891" name="" id="no_telp" required>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="metode">Metode Pembayaran</label>
                        <select
                            class="select2-basic w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            name="" id="metode-select" onchange="updatePath()">
                            <option value="va">Transfer Virtual Account</option>
                            <option value="bank">Transfer Bank</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="metode">Catatan Pemesanan (opsional)</label>
                        <textarea
                            class="col-span-9 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            name="" id="" cols="30" rows="5" style="resize: none"></textarea>
                    </div>
                    <div class="flex">
                        <a id="bayar-button-bank" href="/bank-payment" style="display: none"
                            class="relative w-full bg-gray-800 hover:bg-opacity-90 rounded-lg p-2 mt-4 font-semibold text-white text-center">
                            Bayar
                        </a>
                        <a id="bayar-button-va" data-micromodal-trigger="pilih-va"
                            class="relative w-full bg-gray-800 hover:bg-opacity-90 rounded-lg p-2 mt-4 font-semibold text-white text-center">
                            Bayar
                        </a>
                    </div>
                </div>
            </form>
        </div>
        {{-- total price --}}
        <div class="col-span-8 lg:col-span-3 mt-8 lg:mt-0">
            <div class="rounded-lg shadow-custom1 p-4">
                <p class="font-semibold">Detail Pesanan</p>
                <hr class="mt-3 mb-2 border-gray-800">
                <div class="flex bg-gray-300 py-1 font-bold">
                    <p class="">Nama Produk</p>
                    <p class="ml-auto">Subtotal</p>
                </div>
                @foreach ($data as $item)
                    <div class="flex">
                        <p class="text-gray-400">{{ $item->barang->nama }}</p>
                        <p class="text-gray-400 ml-auto">
                            Rp{{ number_format($item->barang->harga * 1000, 0, ',', '.') }},00</p>
                    </div>
                @endforeach
                {{-- @for ($i = 0; $i < 2; $i++)
                @endfor --}}
                <hr class="my-2 border-gray-800">
                <div class="flex font-bold">
                    <p class="">Subtotal Produk</p>
                    <p class="ml-auto">Rp{{ number_format($totalHarga * 1000, 0, ',', '.') }},00</p>
                </div>
                <div class="flex font-bold">
                    <p class="">Ongkos Kirim</p>
                    <p class="ml-auto">Rp10.000,00</p>
                </div>
                <hr class="my-2 border-gray-800">
                <div class="flex font-bold">
                    <p class="">Total</p>
                    <p class="ml-auto">Rp{{ number_format($totalHarga * 1000 + 10000, 0, ',', '.') }},00</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================================================================
        PILIH VIRTUAL ACCOUNT MODAL
    ======================================================================== --}}
    <div class="modal micromodal-slide" id="pilih-va" aria-hidden="true">
        <div class="modal__overlay" data-micromodal-close>
            <div class="modal__container h-52 w-6/12" role="dialog" aria-modal="true" aria-labelledby="pilih-va-title"
                style="height: 30rem; max-width: 45rem; display: flex; flex-direction: column; justify-content: space-between; margin: 0 1rem;">
                <div>
                    <header class="modal__header border-b-2 pb-1">
                        <h2 class="modal__title text-center text-xl" id="pilih-va-title">
                            Pembayaran via Virtual Account
                        </h2>
                    </header>
                    <main class="modal__content mt-3" id="pilih-va-content">
                        <div class="mx-auto">
                            <div class="flex justify-between">
                                <p class="text-lg">Total Nominal Transfer</p>
                                <p class="text-lg">
                                    Rp{{ number_format($totalHarga * 1000 + 10000, 0, ',', '.') }},00</p>
                            </div>
                            <hr class="my-2">
                        </div>
                        <div class="mx-auto">
                            <label class="flex flex-col" for="va-bank-select">
                                Pilih Virtual Account
                                <select
                                    class="select2-basic w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    name="va-bank-select" id="va-bank-select">
                                    <option value="bca">🏧 Bank BCA</option>
                                    <option value="bni">🏧 Bank BNI</option>
                                    <option value="mandiri">🏧 Bank Mandiri</option>
                                </select>
                            </label>
                        </div>
                    </main>
                </div>
                <footer class="flex justify-end">
                    <a type="button" href="/va-payment"
                        class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-full px-4 py-1">Bayar</a>
                </footer>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2-basic').select2({
                minimumResultsForSearch: Infinity
            });
        });

        /* ========================================================================
            BAYAR BUTTON FUNCTIONS
        ======================================================================== */
        const updatePath = () => {
            console.log()
            if ($("#metode-select").val() == "va") {
                $("#bayar-button-bank").hide();
                $("#bayar-button-va").show();
            } else {
                $("#bayar-button-va").hide();
                $("#bayar-button-bank").show();
            }
            MicroModal.init({
                awaitCloseAnimation: true,
                disableFocus: true,
            });
        }

        /* ========================================================================
            START ::: DATA PROVINSI, KABUPATEN, dan KECAMATAN FETCHING
        ======================================================================== */
        let urlProvinsi = "https://ibnux.github.io/data-indonesia/provinsi.json";
        let urlKabupaten = "https://ibnux.github.io/data-indonesia/kabupaten/";
        let urlKecamatan = "https://ibnux.github.io/data-indonesia/kecamatan/";
        let urlKelurahan = "https://ibnux.github.io/data-indonesia/kelurahan/";

        function clearOptions(id) {
            console.log("on clearOptions");

            //$('#' + id).val(null);
            $('#' + id).empty().trigger('change');
        }

        console.log('Load Provinsi...');
        $.getJSON(urlProvinsi, function(res) {

            res = $.map(res, function(obj) {
                obj.text = obj.nama
                return obj;
            });

            data = [{
                id: "",
                nama: "- Pilih Provinsi -",
                text: "- Pilih Provinsi -"
            }].concat(res);

            $("#select2-provinsi").select2({
                dropdownAutoWidth: true,
                width: '100%',
                data: data
            })
        });

        let selectProv = $('#select2-provinsi');
        $(selectProv).change(function() {
            console.log("on change selectProv");

            let value = $(selectProv).val();
            let text = $('#select2-provinsi :selected').text();
            console.log("value = " + value + " / " + "text = " + text);

            clearOptions('select2-kabupaten');
            console.log('Load Kabupaten di ' + text + '...')
            $.getJSON(urlKabupaten + value + ".json", function(res) {

                res = $.map(res, function(obj) {
                    obj.text = obj.nama
                    return obj;
                });

                data = [{
                    id: "",
                    nama: "- Pilih Kabupaten -",
                    text: "- Pilih Kabupaten -"
                }].concat(res);

                $("#select2-kabupaten").select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    data: data
                })
            })
        });

        let selectKab = $('#select2-kabupaten');
        $(selectKab).change(function() {
            console.log("on change selectKab");

            let value = $(selectKab).val();
            let text = $('#select2-kabupaten :selected').text();
            console.log("value = " + value + " / " + "text = " + text);

            clearOptions('select2-kecamatan');
            console.log('Load Kecamatan di ' + text + '...')
            $.getJSON(urlKecamatan + value + ".json", function(res) {

                res = $.map(res, function(obj) {
                    obj.text = obj.nama
                    return obj;
                });

                data = [{
                    id: "",
                    nama: "- Pilih Kecamatan -",
                    text: "- Pilih Kecamatan -"
                }].concat(res);

                $("#select2-kecamatan").select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    data: data
                })
            })
        });

        let selectKec = $('#select2-kecamatan');
        $(selectKec).change(function() {
            console.log("on change selectKec");

            let value = $(selectKec).val();
            let text = $('#select2-kecamatan :selected').text();
            console.log("value = " + value + " / " + "text = " + text);

            clearOptions('select2-kelurahan');
            console.log('Load Kelurahan di ' + text + '...')
            $.getJSON(urlKelurahan + value + ".json", function(res) {

                res = $.map(res, function(obj) {
                    obj.text = obj.nama
                    return obj;
                });

                data = [{
                    id: "",
                    nama: "- Pilih Kelurahan -",
                    text: "- Pilih Kelurahan -"
                }].concat(res);

                $("#select2-kelurahan").select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    data: data
                })
            })
        });
        /* ========================================================================
            END ::: DATA PROVINSI, KABUPATEN, dan KECAMATAN FETCHING
        ======================================================================== */
    </script>
</x-layout>
