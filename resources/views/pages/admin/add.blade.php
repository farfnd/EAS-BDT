<x-admin.layout>
  {{-- ======== START ::: REQUIRED CDNS ======== --}}
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <link rel='stylesheet' href='https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css'>
  {{-- ======== END ::: REQUIRED CDNS ======== --}}

  {{-- ======== START ::: INI BARU CONTOH MAKENYA NANTI BISA LANGSUNG PAKE DARI DATA HASIL REQ KE BACKEND ======== --}}
  <div class="mt-4 mx-4 flex justify-between py-4 px-3 rounded-tl-lg rounded-tr-lg bg-gray-300 border-b-2 border-gray-400">
    <h1 class="font-bold text-2xl">Data Barang</h1>
    <button data-micromodal-trigger="beri-ulasan" class="bg-gray-800 hover:bg-opacity-90 text-white py-1 px-3 rounded-md" style="">
      <i class='bx bx-plus'></i> Tambah Barang
    </button>
  </div>
  <table id="table-barang" class="display table-barang" style="width:100%">
    <thead class="bg-black text-white">
      <tr>
        <th style="font-weight: 100">#</th>
        <th style="font-weight: 100">Kode Barang</th>
        <th style="font-weight: 100">Nama Barang</th>
        <th style="font-weight: 100">Kategori</th>
        <th style="font-weight: 100">Rating</th>
        <th style="font-weight: 100">Gender</th>
        <th style="font-weight: 100">Stok</th>
        <th style="font-weight: 100">Harga Jual</th>
        <th style="font-weight: 100">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @for ($i = 0; $i < 100; $i++)
        <tr>
          <td>{{ $i }}</td>
          <td>A001{{ $i }}</td>
          <td>Sweater Logo Fav Maroon</td>
          <td>Luaran</td>
          <td>4 Star</td>
          <td>Men</td>
          <td>750</td>
          <td>Rp 350.000</td>
          <td><button class="bg-yellow-300 px-3 py-1 rounded-md hover:bg-yellow-400">Edit</button></td>
        </tr>
      @endfor
    </tbody>
    <tfoot class="bg-black text-white">
      <tr>
        <th>#</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Rating</th>
        <th>Gender</th>
        <th>Stok</th>
        <th>Harga Jual</th>
        <th>Aksi</th>
      </tr>
    </tfoot>
  </table>
  {{-- ======== END ::: INI BARU CONTOH MAKENYA NANTI BISA LANGSUNG PAKE DARI DATA HASIL REQ KE BACKEND ======== --}}
  {{-- modal beri ulasan--}}
  <div class="modal micromodal-slide" id="beri-ulasan" aria-hidden="true">
    <div class="modal__overlay" data-micromodal-close>
    <div class="modal__container" role="dialog" 
        aria-modal="true" aria-labelledby="beri-ulasan-title"
        style="height: 40rem; width: 55rem; display: flex; 
                flex-direction: column; justify-content: space-between; margin: 0 1rem;">
        <div>
            <header class="modal__header border-b-2 pb-1">
                <h2 class="modal__title text-center" id="beri-ulasan-title" style="font-size: 1.8rem">
                    Formulir Data Barang
                </h2>
            </header>
            <main class="modal__content mt-3" id="beri-ulasan-content">
              <form action="" method="post">
				@csrf
                <div class="flex flex-col space-y-5">
                    <div class="grid grid-cols-12">
                      <label for="nama" class="col-span-3">Nama Barang</label>
                      <input type="text"
						class="col-span-9 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Sweater Gray Big Size" name="" id="nama" required maxlength="100">
                    </div>
                    <div class="grid grid-cols-12">
                      <label for="harga" class="col-span-3">Harga Barang</label>
                      <div class="flex col-span-9">
                        <span class="flex items-center bg-grey-lighter rounded rounded-r-none border border-r-0 border-gray-300 px-3 text-grey-dark text-sm">Rp.</span>
                        <input type="text" 
							class="w-full border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
							placeholder="250" name="" id="harga" required>
                        <span class="flex items-center bg-grey-lighter rounded rounded-l-none border border-l-0 border-gray-300 px-3 text-grey-dark text-sm">.000</span>
                      </div>			
                    </div>
                    <div class="grid grid-cols-12">
                      <label for="kategori" class="col-span-3">Kategori Barang</label>
                      <select class="col-span-9 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
					  	name="" id="kategori">
                        <option value="">Jaket</option>  
                        <option value="">Gatau</option>  
                        <option value="">Apa</option>  
                        <option value="">Lagi</option>  
                      </select>  
                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-3">
							<label for="stok">Stok Barang</label>
                        </div> 
                        <div class="col-span-9 flex items-center justify-between space-x-8">
							<input class="w-1/2 rounded-md border-gray-300 
								shadow-sm focus:border-indigo-300 focus:ring 
								focus:ring-indigo-200 focus:ring-opacity-50" 
								type="number" id="stok" name="">
							<div class="w-1/2 flex justify-end space-x-6">
								<label for="gender">Gender</label>
								<select class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
									name="" id="gender">
									<option value="">Pria</option>
									<option value="">Wanita</option>
								</select>
							</div>
                        </div>
                    </div>	
					<div class="grid grid-cols-12">
						<label for="deskripsi" class="col-span-3">Deskripsi Barang</label>
						<textarea 
							placeholder="Masukan deskripsi barang" 
							class="col-span-9 rounded-md border-gray-300 
							shadow-sm focus:border-indigo-300 focus:ring 
							focus:ring-indigo-200 focus:ring-opacity-50" 
							name="" id="deskripsi" cols="30" rows="5" style="resize: none"></textarea>
					</div>
					<div class="grid grid-cols-12">
						<p class="col-span-3">Unggah Foto</p>
						<div class="col-span-9">
							<div class="flex space-x-6">
								<div>
									<label for="file-upload" class="custom-file-upload cursor-pointer">
										<p class="w-32 bg-gray-700 text-regular text-white shadow-md hover:shadow-lg rounded-md px-4 py-1">Upload Files</p>
									</label>
									<input id="file-upload" type="file" class="hidden"/>
								</div>
								<span>Harus berupa file gambar dengan ekstensi .jpg, .jpeg, atau .png</span>
							</div>
						</div>
					</div>
					<div class="flex mt-12 space-x-4 justify-end">
						<button data-micromodal-close class="shadow-custom1 rounded-lg px-4 py-1">
							<span class="font-semibold text-center">Batalkan</span>
						</button>
						<button type="submit" class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-lg px-4 py-1">Kirim</button>
					</div>
                </div>
              </form>
            </main>
        </div>
    </div>
    </div>
  </div>
</x-admin.layout>
<script>
  $(document).ready(function() {
    $('#table-barang').DataTable();
  });
</script>
