<x-layout titlePage="Hanaka | Cart">
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            -moz-appearance: none;
            margin: 0;
        }

    </style>
    <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">Keranjang</h2>
    <div class="grid grid-cols-8 gap-x-8 mx-8 mt-4">
        {{-- card section --}}
        <div class="md:mb-6 col-span-8 lg:col-span-5 flex flex-col">
            <div class="flex flex-col space-y-8">
                @foreach (Auth::user()->keranjang as $barangKeranjang)
                    <!-- @dump($barangKeranjang->barang) -->
                    <div class="flex content-center items-center space-x-4 rounded-lg shadow-custom1 p-4">
                        <input
                            class="check-barang text-indigo-500 border-gray-300 rounded-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="checkbox" name="" data-id="{{ $barangKeranjang->barang->id }}"
                            id="check-barang-{{ $barangKeranjang->barang->id }}" onclick="updateData()">
                        <div class="cart-item-image-container rounded-lg"
                            style="background-image: url({{ route('show_product_image', $barangKeranjang->barang->foto) }}); background-size: cover; backround-repeat: none">
                        </div>
                        <div class="flex flex-col flex-grow h-full">
                            <div>
                                <h4 class="text-lg font-semibold">{{ $barangKeranjang->barang->nama }}</h4>
                                <div class="flex">
                                    <p class="pr-2">
                                        {{ 'Rp' . number_format($barangKeranjang->barang->harga * 1000, 0, ',', '.') }}
                                    </p>|
                                    <p class="harga-barang pl-2 font-bold"
                                        data-id="{{ $barangKeranjang->barang->id }}"
                                        data-harga-total="{{ $barangKeranjang->barang->harga * $barangKeranjang->jumlah }}"
                                        data-harga="{{ $barangKeranjang->barang->harga }}"
                                        id="harga-barang-{{ $barangKeranjang->barang->id }}">
                                        {{ 'Rp' . number_format($barangKeranjang->barang->harga * 1000 * $barangKeranjang->jumlah, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-end items-center mt-auto">
                                <div class="flex flex-col align-center"
                                    onclick="deleteItem({{ $barangKeranjang->barang->id }})"><i
                                        class='text-2xl text-gray-400 hover:text-blue-500 cursor-pointer bx bx-trash'></i>
                                </div>
                                <p class="text-gray-400">&nbsp;|&nbsp;</p>
                                <div class="flex items-center space-x-1">
                                    <i class='text-2xl text-gray-400 hover:text-blue-500 cursor-pointer bx bx-minus'
                                        onclick="subtractBarang({{ $barangKeranjang->barang->id }})"></i>
                                    <input value="{{ $barangKeranjang->jumlah }}" min="1" max="99" type="number"
                                        inputmode="numeric" id="jumlah-barang-{{ $barangKeranjang->barang->id }}"
                                        data-id="" name="input-jumlah"
                                        oninput="updateBarang({{ $barangKeranjang->barang->id }})"
                                        class="jumlah_barang text-center w-14 h-6 border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <i class='text-2xl text-gray-400 hover:text-blue-500 cursor-pointer bx bx-plus'
                                        onclick="addBarang({{ $barangKeranjang->barang->id }})"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- total price --}}
        <form method="post" href="{{ route('cart_post') }}" id="total-checkout"
            class="col-span-8 lg:col-span-3 mt-8 lg:mt-0">
            @csrf
            <div class="rounded-lg shadow-custom1 p-4">
                <p class="font-semibold">Ringkasan Belanja</p>
                <hr class="my-4 border-gray-800">
                <div class="flex">
                    <p class="text-gray-400">Total Harga</p>
                    <p class="harga-detail text-gray-400 ml-auto">Rpxxx.xxx,xx</p>
                </div>
                <div class="flex">
                    <p class="text-gray-400">Total Diskon</p>
                    <p class="text-gray-400 ml-auto">Rp0</p>
                </div>
                <hr class="my-4 border-gray-800">
                <div class="flex">
                    <p class="font-semibold">Total Belanja</p>
                    <p class="harga-belanja font-semibold ml-auto">Rpxxx.xxx,xx</p>
                </div>
                <button type="submit" class="relative w-full bg-gray-800 hover:bg-opacity-90 rounded-lg p-2 mt-4">
                    <span>
                        <p class="font-semibold text-white text-center">Checkout</p>
                    </span>
                </button>
                <div id="temp-checkout"></div>
            </div>
        </form>
    </div>
    <script>
        /* ======== UPDATE JUMLAH BARANG SAAT JUMLAH BARANG DIMASUKKAN ======== */
        const updateBarang = (index) => {
            if (Number($(`#jumlah-barang-${index}`).val()) > 999) {
                $(`#jumlah-barang-${index}`).val(999);
            } else if (Number($(`#jumlah-barang-${index}`).val()) < 1) {
                $(`#jumlah-barang-${index}`).val(1);
            }
            let harga = Number($(`#harga-barang-${index}`).data("harga") * 1000 * $(`#jumlah-barang-${index}`).val());
            $(`#harga-barang-${index}`).html(`Rp${String(harga).replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`);
            $(`#harga-barang-${index}`).data("harga-total", harga / 1000)
            updateData();
            updateItem(index, $(`#jumlah-barang-${index}`).val());
        }

        /* ======== UPDATE JUMLAH BARANG SAAT TOMBOL (+) DITEKAN ======== */
        const addBarang = (index) => {
            if ($(`#jumlah-barang-${index}`).val() < 999) {
                $(`#jumlah-barang-${index}`).val(Number($(`#jumlah-barang-${index}`).val()) + 1);
            }
            let harga = Number($(`#harga-barang-${index}`).data("harga") * 1000 * $(`#jumlah-barang-${index}`).val());
            $(`#harga-barang-${index}`).html(`Rp${String(harga).replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`);
            $(`#harga-barang-${index}`).data("harga-total", harga / 1000)
            updateData();
            updateItem(index, $(`#jumlah-barang-${index}`).val());
        }

        /* ======== UPDATE JUMLAH BARANG SAAT TOMBOL (-) DITEKAN ======== */
        const subtractBarang = (index) => {
            if ($(`#jumlah-barang-${index}`).val() > 1) {
                $(`#jumlah-barang-${index}`).val(Number($(`#jumlah-barang-${index}`).val()) - 1);
            }
            let harga = Number($(`#harga-barang-${index}`).data("harga") * 1000 * $(`#jumlah-barang-${index}`).val());
            $(`#harga-barang-${index}`).html(`Rp${String(harga).replace(/\B(?=(\d{3})+(?!\d))/g, '.')},00`);
            $(`#harga-barang-${index}`).data("harga-total", harga / 1000)
            updateData();
            updateItem(index, $(`#jumlah-barang-${index}`).val());
        }

        /* ======== UPDATE DATA TOTAL HARGA ======== */
        const updateData = () => {
            let harga = 0;
            $(".harga-barang").each(function() {
                if ($(`#check-barang-${$(this).data("id")}`).prop("checked")) {
                    harga += $(this).data("harga-total");
                }
            })
            const totalHarga = $(".harga-detail")[0];
            const hargaBelanja = $(".harga-belanja")[0];
            totalHarga.innerHTML = `Rp${String(harga*1000).replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`;
            hargaBelanja.innerHTML = `Rp${String(harga*1000).replace(/\B(?=(\d{3})+(?!\d))/g, '.')}`;
            getChecked();
        }


        /* ======== ON DELETE ITEM FROM CART ======== */
        const deleteItem = (id) => {
            Swal.fire({
                title: 'Hapus Barang dari Keranjang?',
                html: `Apakah anda yakin akan menghapus barang ini?`,
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: "/api/deleteFromCart/" + id,
                        async: false,
                        headers: {
                            'Authorization': '{{ session('Authorization') }}'
                        },
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                text: 'Barang berhasil dihapus',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                        }
                    }).always(data => {
                        console.log(data)
                    })
                }
            });
        }

        /* ======== ON UPDATE ITEM COUNT FROM CART ======== */
        const updateItem = (id, count) => {
            $.ajax({
                type: 'PUT',
                url: "/api/updateCart/" + id,
                async: false,
                headers: {
                    'Authorization': '{{ session('Authorization') }}'
                },
                data: {
                    _token: "{{ csrf_token() }}",
                    count,
                },
            });
        }

        /* ======== Get Checked Item on Checkout Click ======== */
        const getChecked = (e) => {
            let idList = [];
            $(".check-barang").each(function() {
                let idBarang = $(this).data("id")
                if ($(`#check-barang-${idBarang}`).prop("checked")) {
                    idList.push(idBarang)
                }
            });
            // console.log(idList)
            idList.forEach(element => {
                if (!($(`.input-total-${element}`)[0])) {
                    $('#temp-checkout')
                        .append(
                            `<input type="hidden" class="input-total-${element}" value="${element}" name="input-total-${element}"></>`
                        );
                }
            });

            // $.ajax({
            //     type: 'POST',
            //     url: "/api/checkoutFromCart",
            //     async: true,
            //     headers: {
            //         'Authorization': '{{ session('Authorization') }}'
            //     },
            //     data: {
            //         _token: "{{ csrf_token() }}",
            //         idList,
            //     },
            // }).always(data => console.log(data));
        }
        updateData();
    </script>
</x-layout>
