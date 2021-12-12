<x-admin.layout titlePage="Hanaka Admin | Barang">
  {{-- ======== START ::: REQUIRED CDNS ======== --}}
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <link rel='stylesheet' href='https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css'>
  {{-- ======== END ::: REQUIRED CDNS ======== --}}

  {{-- ======== START ::: INI BARU CONTOH MAKENYA NANTI BISA LANGSUNG PAKE DARI DATA HASIL REQ KE BACKEND ======== --}}
  <div class="mt-4 mx-4 flex justify-between py-4 px-3 rounded-tl-lg rounded-tr-lg bg-gray-300 border-b-2 border-gray-400">
    <h1 class="font-bold text-2xl">Data Barang</h1>
    <button data-micromodal-trigger="tambah-barang" class="bg-gray-800 hover:bg-opacity-90 text-white py-1 px-3 rounded-md" style="">
      <i class='bx bx-plus'></i> Tambah Barang
    </button>
  </div>
  <table  id="table-barang" class="display table-barang" style="width:100%">
    <thead class="bg-black text-white">
      <tr>
        <th style="font-weight: 100">#</th>
        {{-- <th style="font-weight: 100">Kode Barang</th> --}}
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
      @foreach ($barangAll as $key => $barang)
	  <tr>
		<td>{{ $key+1 }}</td>
		{{-- <td>A001{{ $i }}</td> --}}
		<td>{{ $barang->nama }}</td>
		<td>{{ $barang->kategori }}</td>
		<td>{{ $barang->rating }}</td>
		<td>
			@if ($barang->gender == 0)
				Pria
			@elseif ($barang->gender == 1)
				Wanita
			@elseif ($barang->gender == 2)
				Unisex
			@endif
		</td>
		<td>{{ $barang->stok }}</td>
		<td>{{"Rp".number_format($barang->harga*1000,0,',','.')}}</td>
		<td>
			<button data-micromodal-trigger="edit-barang" class="bg-yellow-300 px-3 py-1 rounded-md hover:bg-yellow-400 edit-barang-btn" data-id="{{$barang->id}}">Edit</button>
			<button class="bg-red-500 px-3 py-1 rounded-md hover:bg-red-400 text-white delete-barang-btn" data-id="{{$barang->id}}" data-nama="{{$barang->nama}}">Hapus</button>
		</td>
	  </tr>
	  @endforeach
    </tbody>
    <tfoot class="bg-black text-white">
      <tr>
        <th>#</th>
        {{-- <th>Kode Barang</th> --}}
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
  

  {{-- ========================================================================
	  MODAL TAMBAH BARANG
  ======================================================================== --}}
  <div class="modal micromodal-slide" id="tambah-barang" aria-hidden="true">
    <div class="modal__overlay" data-micromodal-close>
    <div class="modal__container" role="dialog" 
        aria-modal="true" aria-labelledby="tambah-barang-title"
        style="width: 55rem; display: flex; 
                flex-direction: column; justify-content: space-between; margin: 0 1rem;">
        <div>
            <header class="modal__header border-b-2 pb-1">
                <h2 class="modal__title text-center" id="tambah-barang-title" style="font-size: 1.8rem">
                    Formulir Data Barang
                </h2>
            </header>
            <main class="modal__content mt-3" id="tambah-barang-content">
              <form action="{{route('admin.barang.create')}}" method="post" id="formTambahBarang" enctype="multipart/form-data">
				@csrf
                <div class="flex flex-col space-y-5">
                    <div class="grid grid-cols-12">
                      <label for="nama" class="col-span-3">Nama Barang</label>
                      <input type="text"
						class="col-span-9 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Sweater Gray Big Size" name="nama" id="nama" required maxlength="100">
                    </div>
                    <div class="grid grid-cols-12">
                      <label for="harga" class="col-span-3">Harga Barang</label>
                      <div class="flex col-span-9">
                        <span class="flex items-center bg-grey-lighter rounded rounded-r-none border border-r-0 border-gray-300 px-3 text-grey-dark text-sm">Rp.</span>
                        <input type="text" 
							class="w-full border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
							placeholder="250" name="harga" id="harga" required>
                        <span class="flex items-center bg-grey-lighter rounded rounded-l-none border border-l-0 border-gray-300 px-3 text-grey-dark text-sm">.000</span>
                      </div>			
                    </div>
                    <div class="grid grid-cols-12">
						<label for="kategori" class="col-span-3">Gender</label>
						<div class="col-span-9 flex space-x-6">
							<select required class="w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
								name="gender" id="gender">
								<option value="0">Pria</option>
								<option value="1">Wanita</option>  
								<option value="2">Unisex</option>  
							</select>
							<div class="w-1/2 flex justify-end space-x-8">
								<label for="gender">Kategori Barang</label>
								<select required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="kategori_id" id="kategori">
								</select>
							</div>  
						</div>
                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-3">
							<label for="stok">Stok Barang (ukuran)</label>
                        </div> 
                        <div class="col-span-9 flex items-center space-x-8">
							@foreach (['S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL'] as $key => $value)
								<div class="flex w-1/4">
									<input required class="w-full rounded-l-md border-gray-300 
										shadow-sm focus:border-indigo-300 focus:ring 
										focus:ring-indigo-200 focus:ring-opacity-50" 
										type="number" id="stok_{{$key}}" name="stok[{{$key}}]">
									<span class="flex items-center bg-grey-lighter rounded-r-md border border-l-0 border-gray-300 px-3 text-grey-dark text-sm">({{$value}})</span>
								</div>
							@endforeach
                        </div>
                    </div>	
					<div class="grid grid-cols-12">
						<label for="deskripsi" class="col-span-3">Deskripsi Barang</label>
						<textarea required
							placeholder="Masukan deskripsi barang" 
							class="col-span-9 rounded-md border-gray-300 
							shadow-sm focus:border-indigo-300 focus:ring 
							focus:ring-indigo-200 focus:ring-opacity-50" 
							name="deskripsi" id="deskripsi" cols="30" rows="5" style="resize: none"></textarea>
					</div>
					<div class="grid grid-cols-12">
						<p class="col-span-3">Unggah Foto</p>
						<div class="col-span-9">
								<div class="flex flex-col space-y-4">
									<div>
										<label class="w-32 bg-gray-700 text-regular text-white shadow-md hover:shadow-lg rounded-md px-4 py-1 custom-file-upload cursor-pointer" style="text-align: center;">
											Unggah Gambar
											<input required accept=".png, .jpg, .jpeg" type="file" style="display: none;" name="foto" id="foto"/>
										</label>
									</div>
									<span class="text-md">Harus berupa file gambar dengan ekstensi .jpg, .jpeg, atau .png</span>
								</div>
							<img src="" style="max-height: 100px; width: auto" class="my-3" id="previewImgAdd">
						</div>
					</div>
					<div class="flex mt-12 space-x-4 justify-end">
						<button data-micromodal-close class="shadow-custom1 rounded-lg px-4 py-1" id="add-cancel-btn">
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


  {{-- ========================================================================
	  MODAL EDIT BARANG
  ======================================================================== --}}
  <div class="modal micromodal-slide" id="edit-barang" aria-hidden="true">
    <div class="modal__overlay" data-micromodal-close>
    <div class="modal__container" role="dialog" 
        aria-modal="true" aria-labelledby="edit-barang-title"
        style="width: 55rem; display: flex; 
                flex-direction: column; justify-content: space-between; margin: 0 1rem;">
        <div>
            <header class="modal__header border-b-2 pb-1">
                <h2 class="modal__title text-center" id="edit-barang-title" style="font-size: 1.8rem">
                    Formulir Edit Barang
                </h2>
            </header>
			<main class="modal__content mt-3" id="edit-barang-content">
				<form action="{{ route('admin.barang.edit') }}" method="post" id="formEditBarang" enctype="multipart/form-data">
					@method('PUT')
					@csrf
					<div class="flex flex-col space-y-5">
						<div class="grid grid-cols-12">
						<label for="nama" class="col-span-3">Nama Barang</label>
						<input type="text"
							class="col-span-9 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
							placeholder="Sweater Gray Big Size" name="nama" id="nama_edit" required maxlength="100">
						</div>
						<div class="grid grid-cols-12">
						<label for="harga" class="col-span-3">Harga Barang</label>
						<div class="flex col-span-9">
							<span class="flex items-center bg-grey-lighter rounded rounded-r-none border border-r-0 border-gray-300 px-3 text-grey-dark text-sm">Rp.</span>
							<input type="text" 
								class="w-full border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
								placeholder="250" name="harga" id="harga_edit" required>
							<span class="flex items-center bg-grey-lighter rounded rounded-l-none border border-l-0 border-gray-300 px-3 text-grey-dark text-sm">.000</span>
						</div>			
						</div>
						<div class="grid grid-cols-12">
							<label for="kategori" class="col-span-3">Gender</label>
							<div class="col-span-9 flex space-x-6">
								<select class="w-1/2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
									name="gender" id="gender_edit">
									<option value="0">Pria</option>
									<option value="1">Wanita</option>  
									<option value="2">Unisex</option>  
								</select>
								<div class="w-1/2 flex justify-end space-x-8">
									<label for="gender">Kategori Barang</label>
									<select class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="kategori_id" id="kategori_edit">
										<!-- <option value="0">Pria</option> -->
									</select>
								</div>  
							</div>
						</div>
						<div class="grid grid-cols-12">
							<div class="col-span-3">
								<label for="stok">Stok Barang (ukuran)</label>
							</div> 
							<div class="col-span-9 flex items-center space-x-8">
								@foreach (['S' => 'S', 'M' => 'M', 'L' => 'L', 'XL' => 'XL'] as $key => $value)
									<div class="flex w-1/4">
										<input class="w-full rounded-l-md border-gray-300 
											shadow-sm focus:border-indigo-300 focus:ring 
											focus:ring-indigo-200 focus:ring-opacity-50" 
											type="number" id="stok_edit_{{$key}}" name="stok[{{$key}}]">
										<span class="flex items-center bg-grey-lighter rounded-r-md border border-l-0 border-gray-300 px-3 text-grey-dark text-sm">({{$value}})</span>
									</div>
								@endforeach
							</div>
						</div>	
						<div class="grid grid-cols-12">
							<label for="deskripsi" class="col-span-3">Deskripsi Barang</label>
							<textarea 
								placeholder="Masukan deskripsi barang" 
								class="col-span-9 rounded-md border-gray-300 
								shadow-sm focus:border-indigo-300 focus:ring 
								focus:ring-indigo-200 focus:ring-opacity-50" 
								name="deskripsi" id="deskripsi_edit" cols="30" rows="5" style="resize: none"></textarea>
						</div>
						<div class="grid grid-cols-12">
							<p class="col-span-3">Unggah Foto</p>
							<div class="col-span-9">
								<div class="flex flex-col space-y-4">
									<div>
										<label class="w-32 bg-gray-700 text-regular text-white shadow-md hover:shadow-lg rounded-md px-4 py-1 custom-file-upload cursor-pointer" style="text-align: center;">
											Unggah Gambar
											<input accept=".png, .jpg, .jpeg" type="file" style="display: none;" multiple name="foto[]" id="foto_edit"/>
										</label>
									</div>
									<span class="text-md">Harus berupa file gambar dengan ekstensi .jpg, .jpeg, atau .png</span>
								</div>
								<img src="" style="max-height: 100px; width: auto"  class="my-3" id="previewImg" alt="Data tidak ditemukan">
							</div>
						</div>
						<div class="flex mt-12 space-x-4 justify-end">
							<button data-micromodal-close class="shadow-custom1 rounded-lg px-4 py-1" id="edit-cancel-btn">
								<span class="font-semibold text-center">Batalkan</span>
							</button>
							<button type="submit" class="bg-gray-700 text-white shadow-md hover:shadow-lg rounded-lg px-4 py-1" id="edit-submit-btn">Kirim</button>
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
	if (window.history.replaceState) {
        window.history.replaceState( null, null, window.location.href );
    }
	
    let table = $('#table-barang').DataTable();
    if($(window).outerHeight() < 937){
      table.page.len(10).draw(); 
    }else if($(window).outerHeight() >= 937){
      // $('#table-barang').attr('data-page-length', '25')
      table.page.len(25).draw(); 
    }

    $( window ).resize(function() {
      if($(window).outerHeight() < 937){
        table.page.len(10).draw(); 
      }else if($(window).outerHeight() >= 937){
        // $('#table-barang').attr('data-page-length', '25')
        table.page.len(25).draw(); 
      }
    });

	const an = new AutoNumeric('#harga', {
		decimalCharacter: ",",
		decimalPlaces: 0,
		digitGroupSeparator: "."
	});

	const updateCategory = (gender) => {
		let reqGender = gender == 0 || gender == 2 ? 0 : 1
		$.ajax({
		type : 'GET',
		url: "/api/admin/getKategori/" + reqGender,
		async: false,
		headers: { 'Authorization': '{{ session("Authorization") }}' },
		success : function(data){
				let kategoriOptions = "";
				data.forEach(row => kategoriOptions += `<option value="${row.id}">${row.nama_kategori}</option>`);
				$('#kategori').html(kategoriOptions);
				$('#kategori_edit').html(kategoriOptions);
			}
		});
	}

	let genderId = ($('#gender').val() == 0 || $('#gender').val() == 2 ? 0 : 1);
	updateCategory(genderId);

	$('select[id^="gender"]').on('change', function(){
		genderId = ($('#gender').val() == 0 || $('#gender').val() == 2 ? 0 : 1);
        updateCategory(genderId);
    });

	$('.edit-barang-btn').on('click', function(){
		let id = $(this).data('id');
        $.ajax({
			type : 'GET',
            url: "/api/admin/getBarang/" + id,
			async: false,
			headers: { 'Authorization': '{{ session("Authorization") }}' },
            success : function(data){
            	updateCategory(data.gender);
				$('#edit-submit-btn').data('id', id);
				$('#gender_edit').val(data.gender);
				$('#nama_edit').val(data.nama);
				$('#harga_edit').val(data.harga);
				$('#kategori_edit').val(data.kategori_id);
				$('#deskripsi_edit').val(data.deskripsi);
				$('#stok_edit_S').val(data.stok[0].jumlah);
				$('#stok_edit_M').val(data.stok[1].jumlah);
				$('#stok_edit_L').val(data.stok[2].jumlah);
				$('#stok_edit_XL').val(data.stok[3].jumlah);
				$('#previewImg').attr('src', `/product_images/${data.foto}`)
            }
        });
    });

	/* ======== DELETE BARANG ======== */
	$('.delete-barang-btn').on('click', function(){
		let button = $(this);
		Swal.fire({
			title: 'Hapus Barang',
			html: `Apakah anda yakin akan menghapus barang ini?<br><strong>${button.data('nama')}</strong>`,
			icon: 'error',
			showCancelButton: true,
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type : 'DELETE',
					url: "/api/admin/barang/" + button.data('id'),
					async: false,
					headers: { 'Authorization': '{{ session("Authorization") }}' },
					data: {_token: "{{ csrf_token() }}"},
					success : function(data){
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
	$('#formEditBarang').submit(function (){
		$('<input>').attr({
			type: 'hidden',
			name: 'id',
			value: $('#edit-submit-btn').data('id')
		}).appendTo(this);

		return true;
    });

	/* ======== ON FOTO BARANG BARU CHANGE ======== */
	$('#foto').change(function(e){ 
      if (e.target.files && e.target.files[0]) {
        let reader = new FileReader();
        
        reader.onload = function(e) {
          $('#previewImgAdd').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(e.target.files[0]); // convert to base64 string
      }
    });

	/* ======== ON FOTO BARANG EDIT CHANGE ======== */
	$('#foto_edit').change(function(e){ 
      if (e.target.files && e.target.files[0]) {
        let reader = new FileReader();
        
        reader.onload = function(e) {
          $('#previewImg').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(e.target.files[0]); // convert to base64 string
      }
    });

	$('#add-cancel-btn').on('click', function(e){ 
		$('#previewImgAdd').attr('src', "");
    });
	
  });
</script>
