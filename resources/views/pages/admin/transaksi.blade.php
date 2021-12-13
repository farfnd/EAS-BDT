@php

@endphp

<x-admin.layout titlePage="Hanaka Admin | Barang">
    {{-- ======== START ::: REQUIRED CDNS ======== --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <link rel='stylesheet' href='https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css'>
    {{-- ======== END ::: REQUIRED CDNS ======== --}}

    {{-- ======== START ::: INI BARU CONTOH MAKENYA NANTI BISA LANGSUNG PAKE DARI DATA HASIL REQ KE BACKEND ======== --}}
    <div
        class="mt-4 mx-4 flex justify-between py-4 px-3 rounded-tl-lg rounded-tr-lg bg-gray-300 border-b-2 border-gray-400">
        <h1 class="font-bold text-2xl">Data Transaksi</h1>
        <select
            class="bg-gray-300 rounded-md border-gray-400 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            name="gender" id="gender_edit">
            <option value="0">Transfer</option>
            <option value="1">Virtual Account</option>
        </select>
    </div>
    <table id="table-transaksi" class="display table-transaksi" style="width:100%">
        <thead class="bg-black text-white">
            <tr>
                <th style="font-weight: 100">#</th>
                <th style="font-weight: 100">No Pesanan</th>
                <th style="font-weight: 100">Id Pengguna</th>
                <th style="font-weight: 100">Total Harga</th>
                <th style="font-weight: 100">Bank</th>
                <th style="font-weight: 100">No Rekening</th>
                <th style="font-weight: 100">Tanggal</th>
                <th style="font-weight: 100">Status</th>
                <th style="font-weight: 100">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksiAll as $key => $transaksi)
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td class="text-center">{{ $transaksi->id }}</td>
                    <td class="text-center">{{ $transaksi->user_id }}</td>
                    <td>Rp{{ number_format($transaksi->total_pembayaran, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if (str_starts_with($transaksi->metode, 'va_'))
                            Virtual Account
                        @else
                            {{ $transaksi->nama_bank }}
                        @endif
                    </td>
                    <td class="text-center">{{-- $transaksi->nomor_rekening --}}1029471252918</td>
                    <td class="text-center">{{ $transaksi->updated_at }}</td>
                    <td class="text-center">Dibayar ajg {{-- $transaksi->status_pembayaran --}}</td>
                    <td class="text-center">
                        @if (str_starts_with($transaksi->metode, 'va_'))
                            <p>-</p>
                        @else
                            <button data-micromodal-trigger="verif-transaksi" data-id="{{ $transaksi->id }}"
                                class="bg-yellow-300 px-3 py-1 rounded-md hover:bg-yellow-400 edit-transaksi-btn">Edit
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-black text-white">
            <tr>
                <th style="font-weight: 100">#</th>
                <th style="font-weight: 100">No Pesanan</th>
                <th style="font-weight: 100">Id Pengguna</th>
                <th style="font-weight: 100">Total Harga</th>
                <th style="font-weight: 100">Bank</th>
                <th style="font-weight: 100">No Rekening</th>
                <th style="font-weight: 100">Tanggal</th>
                <th style="font-weight: 100">Status</th>
                <th style="font-weight: 100">Aksi</th>
            </tr>
        </tfoot>
    </table>
    {{-- ======== END ::: INI BARU CONTOH MAKENYA NANTI BISA LANGSUNG PAKE DARI DATA HASIL REQ KE BACKEND ======== --}}

    {{-- ========================================================================
		MODAL EDIT TRANSAKSI
	======================================================================== --}}
    <div class="modal micromodal-slide" id="verif-transaksi" aria-hidden="true">
        <div class="modal__overlay" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="edit-transaksi-title" style="width: 55rem; display: flex; 
                flex-direction: column; justify-content: space-between; margin: 0 1rem;">
                <div>
                    <header class="modal__header border-b-2 pb-1 flex justify-between">
                        <h2 class="modal__title text-center" id="edit-transaksi-title" style="font-size: 1.5rem">
                            Verifikasi Bukti Transfer
                        </h2>
                        <h2 class="modal__title text-center" style="font-size: 1.5rem">
                            ID Pengguna : <span id="verif_user-id"></span>
                        </h2>
                    </header>
                    <main class="modal__content mt-1" id="edit-transaksi-content">
                        <div class="flex flex-col">
                            <div class="flex justify-between mt-4 border-b-2 pb-1 border-gray-300 ">
                                <p class="font-bold">No. Pesanan (Status)</p>
                                <p id="verif_no-pesanan" class="font-bold"></p>
                            </div>
                            <div class="flex flex-col overflow-y-scroll h-3/6 max-h-96">
                                <!-- total harga  -->
                                <div class="flex justify-between mt-4 border-b-2 pb-1 border-gray-300">
                                    <p>Total Harga</p>
                                    <p id="verif_total-harga">Rp975.067</p>
                                </div>
                                <!-- nama pengguna  -->
                                <div class="flex justify-between mt-4 border-b-2 pb-1 border-gray-300">
                                    <p>Nama Pengguna</p>
                                    <p id="verif_nama-pengguna">Michael Alexander</p>
                                </div>
                                <!-- jenis bank  -->
                                <div class="flex justify-between mt-4 border-b-2 pb-1 border-gray-300">
                                    <p>Jenis Bank</p>
                                    <p id="verif_jenis-bank">BCA</p>
                                </div>
                                <!-- nama pemilik rekening  -->
                                <div class="flex justify-between mt-4 border-b-2 pb-1 border-gray-300">
                                    <p>Nama Pemilik Rekening</p>
                                    <p id="verif_nama-rekening">Michael Alexander</p>
                                </div>
                                <!-- nomor rekening  -->
                                <div class="flex justify-between mt-4 border-b-2 pb-1 border-gray-300">
                                    <p>No. Rekening</p>
                                    <p id="verif_no-rekening">01234567890</p>
                                </div>
                                <!-- bukti transfer  -->
                                <div class="flex justify-between mt-4 border-b-2 pb-1 border-gray-300">
                                    <p>Bukti Transfer</p>
                                    <p id="verif_bukti">pic2.ong</p>
                                </div>
                                <div>
                                    <img id="verif_bukti-img" class="block mx-auto mt-10"
                                        src="{{ asset('images/IMG_7800.jpg') }}" alt="">
                                </div>
                            </div>
                            <div class="flex mt-12 space-x-4 justify-end">
                                <button data-micromodal-close class="shadow-custom1 rounded-lg px-4 py-1"
                                    id="edit-cancel-btn">
                                    <span class="font-semibold text-center">Batalkan</span>
                                </button>
                                <button type="submit"
                                    class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-lg px-4 py-1"
                                    id="edit-submit-btn">Verifikasi</button>
                            </div>
                        </div>
                    </main>
                    <div id="output"></div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
<script>
    $(document).ready(function() {
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        let table = $('#table-transaksi').DataTable();
        if ($(window).outerHeight() < 937) {
            table.page.len(10).draw();
        } else if ($(window).outerHeight() >= 937) {
            // $('#table-transaksi').attr('data-page-length', '25')
            table.page.len(25).draw();
        }

        $(window).resize(function() {
            if ($(window).outerHeight() < 937) {
                table.page.len(10).draw();
            } else if ($(window).outerHeight() >= 937) {
                // $('#table-transaksi').attr('data-page-length', '25')
                table.page.len(25).draw();
            }
        });

        // const an = new AutoNumeric('#harga', {
        //     decimalCharacter: ",",
        //     decimalPlaces: 0,
        //     digitGroupSeparator: "."
        // });

        const updateCategory = (gender) => {
            let reqGender = gender == 0 || gender == 2 ? 0 : 1
            $.ajax({
                type: 'GET',
                url: "/api/admin/getKategori/" + reqGender,
                async: false,
                headers: {
                    'Authorization': '{{ session('Authorization') }}'
                },
                success: function(data) {
                    let kategoriOptions = "";
                    data.forEach(row => kategoriOptions +=
                        `<option value="${row.id}">${row.nama_kategori}</option>`);
                    $('#kategori').html(kategoriOptions);
                    $('#kategori_edit').html(kategoriOptions);
                }
            });
        }

        let genderId = ($('#gender').val() == 0 || $('#gender').val() == 2 ? 0 : 1);
        updateCategory(genderId);

        $('select[id^="gender"]').on('change', function() {
            genderId = ($('#gender').val() == 0 || $('#gender').val() == 2 ? 0 : 1);
            updateCategory(genderId);
        });

        $('.edit-transaksi-btn').on('click', function() {
            console.log("CEKREK")
            let id = $(this).data('id');
            $.ajax({
                type: 'GET',
                url: "/api/admin/getTransaksi/" + id,
                async: false,
                headers: {
                    'Authorization': '{{ session('Authorization') }}'
                },
                success: function(data) {
                    $('#verif_no-pesanan').html(data.id);
                    $('#verif_jenis-bank').html(data.nama_bank);
                    $('#verif_user-id').html(data.user_id);
                    $('#verif_nama-pengguna').html(data.nama);
                    $('#verif_nama-rekening').html(data.nama_pemilik_rekening);
                    $('#verif_no-rekening').html(data.no_rekening);
                    $('#verif_bukti').html(data.bukti);
                    // $('#gender_edit').val(data.gender);
                    // $('#nama_edit').val(data.nama);
                    // $('#harga_edit').val(data.harga);
                    // $('#kategori_edit').val(data.kategori_id);
                    // $('#deskripsi_edit').val(data.deskripsi);
                    // $('#stok_edit_S').val(data.stok[0].jumlah);
                    // $('#stok_edit_M').val(data.stok[1].jumlah);
                    // $('#stok_edit_L').val(data.stok[2].jumlah);
                    // $('#stok_edit_XL').val(data.stok[3].jumlah);
                    $('#verif_bukti-img').attr('src', `/transaction_images/${data.bukti}`)
                }
            }).always(data => {
                console.log(data)
                $("#output").html(data);
            })
        });

        /* ======== DELETE BARANG ======== */
        $('.delete-transaksi-btn').on('click', function() {
            let button = $(this);
            Swal.fire({
                title: 'Hapus Barang',
                html: `Apakah anda yakin akan menghapus transaksi ini?<br><strong>${button.data('nama')}</strong>`,
                icon: 'error',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: "/api/admin/transaksi/" + button.data('id'),
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
                    });
                }
            });
        });

        /* ======== EDIT BARANG SUBMIT ======== */
        $('#formEditBarang').submit(function() {
            $('<input>').attr({
                type: 'hidden',
                name: 'id',
                value: $('#edit-submit-btn').data('id')
            }).appendTo(this);

            return true;
        });

        /* ======== ON FOTO BARANG BARU CHANGE ======== */
        $('#foto').change(function(e) {
            if (e.target.files && e.target.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImgAdd').attr('src', e.target.result);
                }

                reader.readAsDataURL(e.target.files[0]); // convert to base64 string
            }
        });

        /* ======== ON FOTO BARANG EDIT CHANGE ======== */
        $('#foto_edit').change(function(e) {
            if (e.target.files && e.target.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#previewImg').attr('src', e.target.result);
                }

                reader.readAsDataURL(e.target.files[0]); // convert to base64 string
            }
        });

        $('#add-cancel-btn').on('click', function(e) {
            $('#previewImgAdd').attr('src', "");
        });

    });
</script>
