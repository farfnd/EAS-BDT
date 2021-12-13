@php
$json = '' . $pembayaran->alamat . '';
$res = json_decode($json);
$curDate = strtotime($pembayaran->created_at);
//dd(json_decode($json));
@endphp

<x-layout titlePage="Hanaka | Payment">
    <div class="mx-4 md:mx-0">
        {{-- title --}}
        <div class="w-full md:w-10/12 mx-auto text-center mb-4">
            <h2 class="text-2xl mt-8 mb-4 font-bold">Detail Pesanan</h2>
        </div>

        {{-- header details --}}
        @if ($pembayaran->status_pembayaran == 'Belum Lunas')
        <div class="shadow-custom1 rounded-lg w-full md:w-10/12 mx-auto mb-8 p-6">
            <p class="text-center">
                Pesanan ini <strong>belum dibayar</strong> dan akan secara otomatis dibatalkan pada
                @if ($pembayaran->metode == 'bank'))
                    <strong>{{ date('d-m-Y h:i:s', strtotime(date_add($pembayaran->created_at, date_interval_create_from_date_string('2 days')))) }}</strong>.
                @elseif (str_starts_with($pembayaran->metode, 'va_'))
                    <strong>{{ date('d-m-Y h:i:s', strtotime(date_add($pembayaran->created_at, date_interval_create_from_date_string('1 day')))) }}</strong>.
                    
                @endif
            </p>
            <hr class="my-2">
            <div class="flex justify-around w-full mx-auto text-center">
                <a data-micromodal-trigger="instruksi-pembayaran"
                    class="cursor-pointer rounded-lg p-2 w-5/12 text-white bg-gray-800 hover:bg-gray-900">
                    Instruksi Pembayaran
                </a>
                @if (!str_starts_with($pembayaran->metode, 'va_'))
                    <button data-micromodal-trigger="form-upload-pembayaran"
                        class="cursor-pointer rounded-lg p-2 w-5/12 text-white bg-gray-800 hover:bg-gray-900"
                        id="unggahBukti-btn">
                        Unggah Bukti Transfer
                    </button>
                @endif
            </div>
        </div>
        @endif
        
        {{-- body details --}}
        <div class="shadow-custom1 rounded-lg w-full md:w-10/12 mx-auto mb-8 p-6">
            <div class="md:w-11/12 mx-auto">
                <div class="flex justify-between">
                    <p class="font-bold">Nomor Pesanan</p>
                    <p class="font-bold" id="pembayaran_id">{{ $pembayaran->id }}</p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p>Status Pesanan</p>
                    <p>{{ $pembayaran->status_pembayaran }}</p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p>Metode Pembayaran</p>
                    <p>
                        @if ($pembayaran->metode == 'bank')
                        Transfer Bank
                        @elseif ($pembayaran->metode == 'va_mandiri')
                        Transfer Virtual Account (Mandiri)
                        @elseif ($pembayaran->metode == 'va_bca')
                        Transfer Virtual Account (BCA)
                        @elseif ($pembayaran->metode == 'va_bni')
                        Transfer Virtual Account (BNI)
                        @endif
                    </p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p>Waktu Pemesanan</p>
                    <p>{{ date('d-m-Y h:i:s', $curDate) }}</p>
                </div>
                <hr class="my-2">
                <div class="flex justify-between">
                    <p class="text-lg font-semibold">Alamat Pengiriman</p>
                </div>
                <hr class="my-2">
                <div class="shadow-custom1 rounded-lg p-4 mb-4">
                    <p>{{ $res->nama_penerima }}</p>
                    <p>(+62) {{ $res->no_telepon }}</p>
                    <p>{{ $res->alamat . ', ' . $res->kecamatan . ', ' . $res->kota_kab . ', ' . $res->provinsi }}</p>
                </div>
                <div class="flex justify-between">
                    <p class="text-lg font-semibold">Pesanan</p>
                </div>
                <hr class="my-2">
                @foreach ($pembayaranDetail as $detail)
                    <div class="mb-4">
                        <div class="flex content-center items-center space-x-4 rounded-lg shadow-custom1 p-4">
                            <div class="payment-detail-item-image-container rounded-lg bg-center"
                                style="background-image: url({{ route('show_product_image', $detail->barang->foto) }}); background-size: cover; backround-repeat: none">
                            </div>
                            <div class="flex flex-col flex-grow h-full">
                                <div>
                                    <h4 class="font-semibold">{{ $detail->barang->nama }}</h4>
                                    <p class="">{{ $detail->jumlah_barang }} x
                                        Rp{{ number_format($detail->barang->harga * 1000, 0, ',', '.') }}</p>
                                </div>
                                <div class="flex justify-end items-center mt-auto font-semibold">
                                    <p class="">
                                        Rp{{ number_format($detail->barang->harga * 1000 * $detail->jumlah_barang, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex justify-between w-full md:w-11/12 mx-auto mt-4 font-bold">
                <p class="font-bold text-lg">Total Pesanan</p>
                <p class="font-bold text-lg">
                    Rp{{ number_format($pembayaran->total_pembayaran + 10000, 0, ',', '.') }}</p>
            </div>
            <hr class="my-2 w-full md:w-11/12 mx-auto">

            {{-- ======== SUMMARY BELANJA ======== --}}
            <div class="shadow-custom1 rounded-lg w-full md:w-11/12 mx-auto mb-8 p-6">
                <div class="mx-auto">
                    <div class="flex justify-between">
                        <p>Subtotal Produk</p>
                        <p>Rp{{ number_format($pembayaran->total_pembayaran, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Ongkos Pengiriman</p>
                        <p>Rp{{ number_format(10000, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Kode Unik</p>
                        <p>Rp{{ number_format($pembayaran->kode_unik, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center gap-8 w-full md:w-10/12 mx-auto text-center">
                <a href="{{ route('payment-invoice', $pembayaran->id) }}"
                    class="flex items-center justify-center rounded-lg p-2 w-4/12 text-white bg-gray-800 hover:bg-gray-900">
                    Cetak Invoice
                </a>
                @if ($pembayaran->status_pembayaran == 'Belum Lunas')
                <form action="{{route('cancel-payment', $pembayaran->id)}}" method="post" style="display: none" id="cancel-payment-form">
                @csrf
                @method('DELETE')
                </form>
                <button id="batalkan-btn" class="rounded-lg p-2 w-4/12 text-white bg-red-600 hover:bg-red-700">
                    Batalkan Transaksi
                </button>
                @endif
            </div>
        </div>
    </div>

    {{-- ======== Modal Instruksi Pembayaran ======== --}}
    <div class="modal micromodal-slide" id="instruksi-pembayaran" aria-hidden="true">
        <div class="modal__overlay" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="edit-barang-title" style="width: 55rem; display: flex; 
                    flex-direction: column; justify-content: space-between; margin: 0 1rem;">
                <div>
                    <header class="modal__header border-b-2 pb-1">
                        <h2 class="modal__title text-center" id="edit-barang-title" style="font-size: 1.8rem">
                            @if ($pembayaran->metode == 'va_bca')
                            Pembayaran via ATM BCA
                            @elseif ($pembayaran->metode == 'va_bni')
                            Pembayaran via ATM BNI
                            @elseif ($pembayaran->metode == 'va_mandiri')
                            Pembayaran via ATM Mandiri
                            @endif
                        </h2>
                    </header>
                    <main class="modal__content mt-3" id="edit-barang-content">
                        <ol class="list-decimal flex flex-col space-y-3 px-5 font-semibold">
                            @if ($pembayaran->metode == 'bank'))
                            <li>
                                <span>
                                    Transfer melalui ATM, teller bank, aplikasi mobile banking, atau internet banking
                                    sejumlah tepat Rp{{ number_format($pembayaran->total_pembayaran + 10000, 0, ',', '.') }} ke nomor rekening berikut:
                                </span>
                                <ul class="list-disc pl-8">
                                    <li>Pilih Bahasa.</li>
                                    <li>Masukkan PIN ATM Anda.</li>
                                    <li>Pilih "Menu Lainnya".</li>
                                </ul>
                            </li>
                            <li>Simpan bukti transaksi, lalu unggah melalui menu ‘Unggah Bukti Transfer’.</li>
                            <li>Isi data sesuai rekening yang Anda gunakan saat melakukan transfer.
                                Jika Anda melakukan transfer melalui teller bank, isi ‘0000’ pada kolom nomor rekening,
                                dan nama Anda pada kolom nama pemilik rekening.</li>
                            @elseif ($pembayaran->metode == 'va_bca')
                            <li>Masukkan Kartu ATM BCA & PIN</li>
                            <li>Pilih menu Transaksi Lainnya > Transfer > ke Rekening BCA Virtual Account</li>
                            <li>Masukkan nomor Virtual Account Anda (contoh: {{$pembayaran->no_va}})</li>
                            <li>Di halaman konfirmasi, pastikan detil pembayaran sudah sesuai seperti No VA, Nama, Perus/Produk dan Total Tagihan</li>
                            <li>Masukkan Jumlah Transfer sesuai dengan Total Tagihan</li>
                            <li>Ikuti instruksi untuk menyelesaikan transaksi</li>
                            <li>Simpan struk transaksi sebagai bukti pembayaran</li>
                            @elseif ($pembayaran->metode == 'va_bni')
                            <li>Masukkan Kartu Anda</li>
                            <li>Pilih Bahasa</li>
                            <li>Masukkan PIN ATM Anda</li>
                            <li>Pilih "Menu Lainnya"</li>
                            <li>Pilih "Transfer"</li>
                            <li>Pilih Jenis rekening yang akan Anda gunakan (Contoh: "Dari Rekening Tabungan")</li>
                            <li>Pilih "Virtual Account Billing"</li>
                            <li>Masukkan nomor Virtual Account Anda (contoh: {{$pembayaran->no_va}})</li>
                            <li>Tagihan yang harus dibayarkan akan muncul pada layar konfirmasi</li>
                            <li>Konfirmasi, apabila telah sesuai, lanjutkan transaksi</li>
                            <li>Transaksi telah selesai</li>
                            @elseif ($pembayaran->metode == 'va_mandiri')
                            <li>Masukkan kartu ATM dan PIN</li>
                            <li>Pilih menu "Bayar/Beli"</li>
                            <li>Pilih menu "Lainnya", hingga menemukan menu "Multipayment"</li>
                            <li>Masukkan Nomor Virtual Account, lalu pilih tombol Benar</li>
                            <li>Akan muncul konfirmasi pembayaran, lalu pilih tombol Ya</li>
                            <li>Simpan struk sebagai bukti pembayaran Anda</li>
                            @endif
                        </ol>
                    </main>
                    <footer class="modal__footer flex justify-end">
                        <button
                            class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-lg px-4 py-1  edit-submit-btn"
                            data-micromodal-close>Tutup</button>
                    </footer>
                </div>
            </div>
        </div>
    </div>
    {{-- ======== Modal Upload Pembayaran ======== --}}
    <div class="modal micromodal-slide" id="form-upload-pembayaran" aria-hidden="true">
        <div class="modal__overlay" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="edit-barang-title" style="width: 55rem; display: flex; 
                    flex-direction: column; justify-content: space-between; margin: 0 1rem;">
                <div>
                    <header class="modal__header border-b-2 pb-1">
                        <h2 class="modal__title text-center" id="edit-barang-title" style="font-size: 1.8rem">
                            Unggah Bukti Transfer
                        </h2>
                    </header>
                    <main class="modal__content mt-3" id="edit-barang-content">
                        <div class="flex justify-between font-bold">
                            <p>Nomor Pesanan</p>
                            <p>{{ $pembayaran->id }}</p>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between font-bold">
                            <p>Total Pesanan</p>
                            <p>Rp{{ number_format($pembayaran->total_pembayaran + 10000, 0, ',', '.') }}</p>
                        </div>
                        <hr class="mt-2 mb-8">
                        {{-- ========================================================================
                        TODO ::: GANTI ROUTE JADI POST TRANSAKSI
                    ======================================================================== --}}
                        <form id="formUnggahBukti" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="flex flex-col space-y-8">
                                <div class="grid grid-cols-12">
                                    <label for="nama_pemilik_rekening" class="col-span-3">Nama Pemilik
                                        Rekening</label>
                                    <input type="text"
                                        class="col-span-9 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        placeholder="Michael Alexander" name="nama_pemilik_rekening"
                                        id="nama_pemilik_rekening" required maxlength="100">
                                </div>
                                <div class="grid grid-cols-12">
                                    <label for="harga" class="col-span-3">Nama Bank</label>
                                    <div class="flex col-span-9">
                                        <select
                                            class="select2-basic w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            name="nama_bank" id="nama_bank">
                                            @foreach ($bankAll as $bank)
                                                <option value="{{ $bank->nama_bank }}">{{ $bank->nama_bank }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12">
                                    <label for="no_rekening" class="col-span-3">Nomor Rekening</label>
                                    <div class="flex col-span-9">
                                        <input type="number"
                                            class="w-full  rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            placeholder="081234567891" name="no_rekening" id="no_rekening" required>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12">
                                    <p class="col-span-3">Unggah Foto</p>
                                    <div class="col-span-9">
                                        <div class="flex flex-col space-y-4">
                                            <div>
                                                <label
                                                    class="w-32 bg-gray-700 text-regular text-white shadow-md hover:shadow-lg rounded-md px-4 py-1 custom-file-upload cursor-pointer"
                                                    style="text-align: center;">
                                                    Unggah Gambar
                                                    <input accept=".png, .jpg, .jpeg" type="file" style="display: none;"
                                                        name="bukti" id="bukti" />
                                                </label>
                                            </div>
                                            <span class="text-md">Harus berupa file gambar dengan ekstensi .jpg,
                                                .jpeg, atau .png</span>
                                        </div>
                                        <img src="" style="max-height: 100px; width: auto" class="my-3"
                                            id="previewImg">
                                    </div>
                                </div>
                                <div class="flex mt-12 space-x-4 justify-end">
                                    <button data-micromodal-close class="shadow-custom1 rounded-lg px-4 py-1">
                                        <span class="font-semibold text-center">Batalkan</span>
                                    </button>
                                    <button type="submit"
                                        class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-lg px-4 py-1  edit-submit-btn"
                                        id="unggahBukti-submit-btn">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </main>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#unggahBukti-btn').click(function(e) {
                $('#unggahBukti-submit-btn').data('id', $('#pembayaran_id').text());
            });

            /* ======== ON FOTO BUKTI TRANSAKSI CHANGE ======== */
            $('#bukti').change(function(e) {
                if (e.target.files && e.target.files[0]) {
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        $('#previewImg').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(e.target.files[0]); // convert to base64 string
                }
            });

            $('#formUnggahBukti').submit(function(e) {
                e.preventDefault();
                $('<input>').attr({
                    type: 'hidden',
                    name: 'id',
                    value: $('#unggahBukti-submit-btn').data('id')
                }).appendTo(this);

                var form = $(this)[0];
                var fd = new FormData(form);
                var file = $('#bukti')[0].files[0];

                $.ajax({
                    type: "POST",
                    url: "/api/editBuktiTransfer",
                    headers: {
                        'Authorization': '{{ session('Authorization') }}'
                    },
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        MicroModal.close('form-upload-pembayaran');
                        Swal.fire({
                            icon: 'success',
                            title: 'Bukti transfer berhasil diunggah',
                        });
                        location.reload();
                    }
                });

                return true;
            });

            $("#batalkan-btn").click(function() {
                Swal.fire({
                    title: 'Batalkan Transaksi',
                    text: 'Apakah Anda yakin akan membatalkan transaksi ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#cancel-payment-form').submit();
                        Swal.fire({
                            title: 'Transaksi Berhasil Dibatalkan',
                            icon: 'success',
                            confirmButtonText: 'OK',
                        });
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });
            })
        })
    </script>
</x-layout>
