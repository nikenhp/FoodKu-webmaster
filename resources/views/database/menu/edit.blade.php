@extends('adminlte::page')

@section('title', 'Menu List Webmaster')

@section('content')
<div class="content">
	<section class="content-header">
		<h1>
			Ubah Data<br>
			<small style="padding-left: 0">Ubah data menu</small>
		</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('home') }}">
					<i class="fa fa-dashboard"></i> Dashboard
				</a>
			</li>
			<li>
				<a href="{{ url('database/menu') }}">
					<i class="fa fa-building"></i> Menu
				</a>
			</li>
			<li><i class="fa fa-edit"></i>&nbsp; Ubah</li>
		</ol>
	</section>

	<section class="content container-fluid main-content-container">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary box-centered">
					<div class="box-header with-border">
						<h3 class="box-title"><b>Ubah data menu</b></h3>
					</div>
					<div class="box-body">
						<form class="form-main form-update" action="{{ url('database/menu/update/'.$menu->id) }}" method="POST" enctype="multipart/form-data">
							{{ csrf_field() }}

							<div class="form-group">
								<label for="kategori">Kategori</label>
								<br>
								<div class="kategori-wrapper" style="width: 400px;">
									<select class="select2" name="kategori" style="width: 100%">
							 			@foreach ($kategori as $data)
							 				@if ($menu->id_category == $data->id)
							 					<option selected value="{{ $data->id }}">{{ $data->category }}</option>
							 				@else
							 					<option value="{{ $data->id }}">{{ $data->category }}</option>
							 				@endif							 					
							 			@endforeach
									</select>
								</div>								
							</div>
							<div class="form-group">
								<label for="name">Nama Menu</label>
								<input type="text" class="form-control" name="nama_menu" id="name" placeholder="Enter menu name" value="{{ $menu->nama_menu }}" required>
							</div>
							<div class="form-group">
								<label for="harga">Harga</label>
								<input type="number" class="form-control" name="harga" id="harga" placeholder="Masukkan harga" value="{{ $menu->harga }}" min="1" required="">								
							</div>
							<div class="form-group">
								<label for="deskripsi">Deskripsi</label>
								<textarea class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukkan deskripsi menu" required="" rows="5">{{ $menu->deskripsi }}</textarea>
							</div>
							<div class="form-group">
								<label for="gambar">Gambar Lama</label><br>
								<img style="width: 300px" src="{{ asset('images/barang/'.$menu->gambar) }}">
							</div>
							<div class="form-group">
								<label for="gambar">Gambar Baru</label>
								<input name="gambar" id="gambar" type="file" class="dropify" data-max-file-size="3M" />
							</div>							

							<a href="{{ url('database/menu') }}" class="btn btn-lg btn-danger btn-flat"><i class="fa fa-trash-o"></i>&nbsp; Batal</a>
							<button type="submit" class="btn btn-lg btn-primary btn-flat"><i class="fa fa-save"></i>&nbsp; Simpan</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection