@extends('adminlte::page')

@section('title', 'User Add')

@section('content')
<div class="content">
	<section class="content-header">
		<h1>
			Ubah Data<br>
			<small style="padding-left: 0">Ubah data user</small>
		</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url('home') }}">
					<i class="fa fa-dashboard"></i> Dashboard
				</a>
			</li>
			<li>
				<a href="{{ url('database/user') }}">
					<i class="fa fa-building"></i> User
				</a>
			</li>
			<li><i class="fa fa-plus"></i>&nbsp; Ubah</li>
		</ol>
	</section>

	<section class="content container-fluid main-content-container">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary box-centered">
					<div class="box-header with-border">
						<h3 class="box-title"><b>Ubah data user</b></h3>
					</div>
					<div class="box-body">
						<form class="form-main form-update" action="{{ url('database/user/update/'.$user->id) }}" method="POST">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="name">Nama User</label>
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter user name" required value="{{ $user->name }}">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" min="1" required="" value="{{ $user->email }}">
							</div>
							<div class="form-group">
								<label for="barcode">Password</label>
								<input type="password" class="form-control" name="password" id="password" placeholder="Enter password" value="">
								<span style="color: gray">*Biarkan kosong jika tidak ingin mengganti</span>
							</div>
							<a href="{{ url('database/user') }}" class="btn btn-lg btn-danger btn-flat"><i class="fa fa-trash-o"></i>&nbsp; Batal</a>
							<button type="submit" class="btn btn-lg btn-primary btn-flat"><i class="fa fa-save"></i>&nbsp; Simpan</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection