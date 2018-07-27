@extends('adminlte::page')

@section('title', 'User List Webmaster')

@section('content')
<div class="content">
	<section class="content-header">
		<h1>
			User<br>
			<small style="padding-left: 0">Daftar semua user yang ada</small>
		</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?= url('dashboard')?>">
					<i class="fa fa-dashboard"></i> Dashboard
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-file-text-o"></i> User
				</a>
			</li>
		</ol>
	</section>

	<section class="content container-fluid main-content-container">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><b>User</b></h3>
					</div>
					<div class="box-body" style="padding: 10px 30px">
						<div class="row">
							<div class="col-md-12">
								<a href="{{ url('/database/user/add') }}" class="btn btn-primary">Tambah user</a>
							</div>
						</div>
						<br>
						<!-- <hr style="border-style: dashed; border-width: 0.8px; border-color: gray"> -->
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-bordered table-striped table-hover" id="laporan" style="width: 100%">
									<thead>
										<tr>
											<td width="50">No.</td>
                                            <td>Name</td>											
                                            <td>Email</td>											
                                            <td>Aksi</td>
										</tr>
									</thead>
									<tbody>
										
									</tbody>
		                        </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">

	var FormData;

	$(document).ready(function() {
		var tableLaporan = $('#laporan').DataTable({			
			"sDom":"ltipr",
			"lengthMenu": [[10, 30, 100, 200, -1], [10, 30, 100, 200, "All"]],
			"scrollX": true,
			"scrollY": true,
			"language": {
	            "lengthMenu": "Tampil _MENU_ data per halaman",
	            "zeroRecords": "Tidak ada data yang ditemukan",
	            "info": "Halaman _PAGE_ dari _PAGES_",
	            "infoEmpty": "Data kosong",
	            "infoFiltered": "(difilter dari total _MAX_ data)",
				"search": "Cari :",
			},
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?= url('/database/user/get_datatable')?>",
				"type": "GET",
			},
			"columnDefs": [
				{
					class: "text-center",
					width: 30,
					"targets": [0],					
					"orderable": false, 
					render: function(data, type, row, meta){
						return meta.row+meta.settings._iDisplayStart+1
					}
				},
				{
					"targets": [1], 
					"data": "name",
					width: 90,
					"orderable": true, 
				},
				{					
					width: 120,
					class: "text-center",
					"orderable": false,
					"targets": [2],
					"data": "email"
				},
				{
					targets: [3],
					data: [0],
					sortable: false,
					searchable: false,
					render: function(data, type, row, meta){
						return "<div class='btn-group'>"+
						"<a href='/database/user/edit/"+row['id']+"' class='btn btn-primary'>Edit</a>"+
						"<a href='/database/user/delete/"+row['id']+"' class='btn btn-danger'>Hapus</a>"+
						"</div>";
					}
				}							
			],
		});

		tableLaporan.draw();
	});
    
</script>

@endsection