<x-layout titlePage="Hanaka | History Transaction">
    <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">Riwayat Pembelian</h2>
    <div class="flex flex-col space-y-5 mx-8 mt-4 mb-6">
        @foreach ($pembayaran as $transaksi)
            @foreach ($transaksi->pembayaranDetail as $item)
                {{-- card 1 item lacak --}}
                <div class="flex flex-col md:flex-row shadow-custom1 rounded-2xl justify-between px-4 py-3 ">
                    {{-- item detail --}}
                    <div class="flex">
                        <div class="rounded-md w-36 bg-cover bg-center"
                            style="background-image: url({{ route('show_product_image', $item->barang->foto) }})">
                        </div>
                        <div class="flex flex-col justify-between py-2 ml-3">
                            <div>
                                <p class="font-medium">Transaksi: <span class="font-semibold">{{ $transaksi->id }} ({{ date('d F Y', strtotime($transaksi->created_at)) }})</span>
                                </p>
                                <p class="text-lg font-semibold">{{ $item->barang->nama }}</p>
                                @if (count($transaksi->pembayaranDetail) == 1)
                                    <p>{{$transaksi->pembayaranDetail[0]->jumlah_barang}}
                                    @if ($transaksi->pembayaranDetail[0]->jumlah_barang == 1)
                                        pc
                                    @elseif ($transaksi->pembayaranDetail[0]->jumlah_barang > 1)
                                        pcs
                                    @endif
                                    @ Rp{{ number_format($transaksi->pembayaranDetail[0]->barang->harga * 1000, 0, ',', '.') }}</p>
                                @elseif (count($transaksi->pembayaranDetail) > 1)
                                    <p>dan {{ count($transaksi->pembayaranDetail)-1 }} barang lainnya</p>
                                @endif
                            </div>
                            <div>
                                <p>Total Harga: <span class="font-semibold">Rp{{ number_format($item->jumlah_barang * 1000 * $item->barang->harga, 0, ',', '.') }} (Lunas)</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- item payment status --}}
                    <div class="flex flex-col justify-between py-2">
                        <div class="md:text-right p-3 md:p-0">
                            <p>Status Pengiriman</p>
                            <p class="font-bold">{{ $transaksi->status_pengiriman }}</p>
                        </div>
                        <div>
                            @if ($transaksi->status_pengiriman == 'Sedang Dikirim')
                                <button
                                    class="relative w-full bg-gray-800 hover:bg-opacity-90 rounded-lg px-2 py-1 mt-4">
                                    <p class="font-semibold text-white text-center">Lacak</p>
                                </button>
                            @elseif ($transaksi->status_pengiriman == "Selesai")
                                <button class="relative w-full shadow-custom1 rounded-lg px-2 py-1 mt-4">
                                    <p class="font-semibold text-center">Selesai</p>
                                </button>
                            @elseif ($transaksi->status_pengiriman == "Beri Ulasan")
                                <button
                                    class="relative w-full bg-gray-800 hover:bg-opacity-90 rounded-lg px-2 py-1 mt-4">
                                    <p class="font-semibold text-white text-center">Beri Ulasan</p>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach

        @for ($i = 0; $i < 2; $i++)
            {{-- modal lacak pesanan --}}
            <div class="modal micromodal-slide" id="lacak-item" aria-hidden="true">
                <div class="modal__overlay" data-micromodal-close>
                    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="lacak-item-title"
                        style="max-width: 45rem; display: flex; flex-direction: column; justify-content: space-between; margin: 0 1rem;">
                        <div>
                            <header class="modal__header border-b-2 pb-1">
                                <h2 class="modal__title text-center" id="lacak-item-title" style="font-size: 1.8rem">
                                    Pelacakan Pesan
                                </h2>
                            </header>
                            <main class="modal__content mt-3" id="lacak-item-content">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-5 flex flex-col space-y-4  mr-4">
                                        <p>Transaksi: <span class="font-bold">A0012 / 23 Mei 2021</span></p>
                                        <img class="w-40" src="{{ asset('images/jacket.png') }}" alt=""
                                            class="item-image">
                                        <p class="font-bold text-lg">Sweater Logo Fav Maroon</p>
                                    </div>
                                    <div
                                        class="text-sm md:text-base font-bold col-span-7 flex flex-col justify-center border-l-2 pl-4">
                                        <div class="mb-2">
                                            <h5 class="font-light">Pembeli</h5>
                                            <p class="ml-3">Putu Michael Arifandi</p>
                                            <p class="ml-3">Jakarta Selatan, Jakarta</p>
                                        </div>
                                        <div class="mb-2">
                                            <h5 class="font-light">Nomor Resi</h5>
                                            <p class="ml-3">024148732358920</p>
                                        </div>
                                        <div class="mb-2">
                                            <h5 class="font-light">Layanan Ekspedisi</h5>
                                            <p class="ml-3">JNE Regular</p>
                                        </div>
                                        <div class="mb-2">
                                            <h5 class="font-light">Status</h5>
                                            <p class="ml-3">Sedang Dikirim</p>
                                        </div>
                                        <div class="mb-2">
                                            <h5 class="font-light">Lokasi</h5>
                                            <p class="ml-3">Transit di warehouse Surabaya</p>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>
                        <footer class="flex justify-end">
                            <button type="button"
                                class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-full px-4 py-1"
                                data-micromodal-close>Kembali</button>
                        </footer>
                    </div>
                </div>
            </div>
            {{-- modal beri ulasan --}}
            <div class="modal micromodal-slide" id="beri-ulasan" aria-hidden="true">
                <div class="modal__overlay" data-micromodal-close>
                    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="beri-ulasan-title"
                        style="width: 50rem; display: flex; 
                                flex-direction: column; justify-content: space-between; margin: 0 1rem;">
                        <div>
                            <header class="modal__header border-b-2 pb-1">
                                <h2 class="modal__title text-center" id="beri-ulasan-title" style="font-size: 1.8rem">
                                    Formulir Ulasan
                                </h2>
                            </header>
                            <main class="modal__content mt-3" id="beri-ulasan-content">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-5 flex flex-col space-y-4  mr-4">
                                        <p>Transaksi: <span class="font-bold">A0012 / 23 Mei 2021</span></p>
                                        <img class="w-40" src="{{ asset('images/jacket.png') }}" alt=""
                                            class="item-image">
                                        <p class="font-bold text-lg">Sweater Logo Fav Maroon</p>
                                    </div>
                                    <div
                                        class="text-sm md:text-base font-bold col-span-7 flex flex-col justify-center border-l-2 pl-4">
                                        <form id="form-ulasan" enctype="multipart/form-data">
                                            @csrf
                                            <div class="flex flex-col">
                                                <label for="komentar" class="mb-2 font-light">Ulasan Anda</label>
                                                <textarea placeholder="Masukan ulasan anda"
                                                    class="rounded-md shadow-custom1" name="ulasan" id="komentar"
                                                    cols="30" rows="5" style="resize: none; border: none"></textarea>
                                            </div>
                                            <div class="flex mt-8">
                                                <div class="mr-8">
                                                    <p class="mb-2 ">Unggah Foto:</p>
                                                    <label for="file_ulasan"
                                                        class="custom-file-upload cursor-pointer bg-gray-700 text-regular text-white shadow-md hover:shadow-lg rounded-md px-4 py-1">
                                                        Unggah Gambar
                                                        <input accept=".png, .jpg, .jpeg" type="file"
                                                            style="display: none;" name="file_ulasan"
                                                            id="file_ulasan" />
                                                    </label>
                                                </div>
                                                <div>
                                                    <div>
                                                        <p class="mb-2 ">Rating:</p>
                                                    </div>
                                                    <div class="rating">
                                                        <div>
                                                            <label>
                                                                <input type="radio" name="rating" value="1" />
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="2" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="3" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="4" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                            <label>
                                                                <input type="radio" name="rating" value="5" />
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                                <span class="icon">★</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <img src="" style="max-height: 100px; width: auto" class="my-3"
                                                id="previewImg">
                                            <div class="flex mt-12 space-x-4 justify-end">
                                                <button data-micromodal-close
                                                    class="shadow-custom1 rounded-lg px-4 py-1">
                                                    <span class="font-semibold text-center">Batalkan</span>
                                                </button>
                                                <button type="submit"
                                                    class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-lg px-4 py-1"
                                                    id="ulasan-submit-btn" data-id="3">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</x-layout>

<script>
    $('#file_ulasan').change(function(e) {
        if (e.target.files && e.target.files[0]) {
            let reader = new FileReader();

            reader.onload = function(e) {
                $('#previewImg').attr('src', e.target.result);
            }

            reader.readAsDataURL(e.target.files[0]); // convert to base64 string
        }
    });

    $('#form-ulasan').submit(function(e) {
        e.preventDefault();
        $('<input>').attr({
            type: 'hidden',
            name: 'id',
            value: $('#ulasan-submit-btn').data('id')
        }).appendTo(this);

        var form = $(this)[0];
        var fd = new FormData(form);
        var file = $('#file_ulasan')[0].files[0];

        $.ajax({
            type: "POST",
            url: "/api/postUlasan",
            headers: {
                'Authorization': '{{ session('Authorization') }}'
            },
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                MicroModal.close('beri-ulasan');
                Swal.fire({
                    icon: 'success',
                    title: 'Bukti transfer berhasil diunggah',
                });
            }
        });

        return true;
    });
</script>
