<x-layout titlePage="Hanaka | Transaction">
    <h2 class="text-3xl font-bold text-gray-900 text-center mt-8">Daftar Transaksi</h2>
    <div class="flex flex-col space-y-5 mx-8 mt-4 mb-6">
        @foreach ($pembayaran as $transaksi)
            @if (count($transaksi->pembayaranDetail))
            <div class="flex flex-col md:flex-row shadow-custom1 rounded-2xl justify-between px-4 py-3 ">
                <div class="flex">
                    <div class="rounded-md w-36 bg-cover bg-center"
                        style="background-image: url({{ route('show_product_image', $transaksi->pembayaranDetail[0]->barang->foto) }})">
                    </div>
                    <div class="flex flex-col justify-between py-2 ml-3">
                        <div>
                            <p class="font-medium">Transaksi: <span class="font-semibold">{{ $transaksi->id }} ({{ date('d F Y', strtotime($transaksi->created_at)) }})</span>
                            </p>
                            <p class="text-lg font-semibold">{{ $transaksi->pembayaranDetail[0]->barang->nama }}</p>
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
                            <p>Total Pembayaran: <span class="font-semibold">Rp{{ number_format($transaksi->total_pembayaran + 10000, 0, ',', '.') }}</span></p>
                        </div>
                    </div>
                </div>
                {{-- item payment status --}}
                <div class="flex flex-col justify-between py-2">
                    <div class="md:text-right p-3 md:p-0">
                        <p>Status Pembayaran</p>
                        <p class="font-bold">{{ $transaksi->status_pembayaran }}</p>
                    </div>
                    <div class="md:text-right">
                        <a href={{route('payment-detail', $transaksi->id)}} class="rounded-lg px-2 py-1 mt-4 w-full text-white bg-gray-800 hover:bg-gray-900">
                            @if ($transaksi->status_pembayaran == 'Belum Lunas')
                            Bayar
                            @else
                            Lihat Detail Pesanan
                            @endif
                        </a>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
</x-layout>
