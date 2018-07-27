@extends('adminlte::page')

@section('title', 'Drink List Webmaster')

@section('content')
<div class="content">
	<section class="content-header">
		<h1>
			Cetak Nota Distribusi<br>
			<small style="padding-left: 0">Cetak nota distribusi barang ke toko</small>
		</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?= url('dashboard')?>">
					<i class="fa fa-dashboard"></i> Dashboard
				</a>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-file-text-o"></i> Cetak Nota Distribusi
				</a>
			</li>
		</ol>
	</section>

	<section class="content container-fluid main-content-container">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title"><b>Nota Distribusi</b></h3>
					</div>
					<div class="box-body" style="padding: 10px 30px">
						<div class="row">
                         	<div class="col-md-3">
								<label for="dari">Dari Tanggal</label>
								<input class="form-control datepicker" id="dari" type="text" name="" value="<?= date('d/m/Y')?>">
							</div>
							<div class="col-md-3">
								<label for="sampai">Sampai Tanggal</label>
								<input class="form-control datepicker" id="sampai" type="text" name="" value="<?= date('d/m/Y')?>">
							</div>
							<div class="col-md-3">
								<label for="sampai">Refresh Data</label><br>
								<button type="button" id="ref" class="btn btn-success" name="refresh"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp; Refresh</button>
							</div>
						</div>
						<hr style="border-style: dashed; border-width: 0.8px; border-color: gray">
						<div class="row">
							<div class="col-md-12">
								<table class="table table-bordered table-bordered table-striped table-hover" id="laporan" style="width: 100%">
									<thead>
										<tr>
											<td width="50">No.</td>
                                            <td>Barang</td>											
                                            <td>Dari Gudang</td>
											<td>Ke Toko</td>
											<td>Tgl Distribusi</td>
											<td>Jumlah</td>
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
				"url": "<?= url('/cetak/nota-distribusi/get_datatable')?>",
				"type": "POST",
				"data": function(d){
					d.store = $('#select_store').val();
					d.dari = $('#dari').val();
					d.sampai = $('#sampai').val();
				}
			},
			"columnDefs": [
				{
					class: "text-center",
					width: 30,
					"targets": [ 0 ],
					"orderable": false, 
				},
				{
					"targets": [ 1 ], 
					width: 90,
					"orderable": true, 
				},
				{					
					width: 120,
					class: "text-center",
					"orderable": false,
					"targets": [2],
				},				
				{
					class: "text-center",
					"orderable": false,
					"targets": [3],
					width: 100,
				},
				{
					class: "text-center",
					width: 80,
					"orderable": false,
					"targets": [4],
				},
				{
					class: "text-center",
					width: 80,
					"orderable": false, 
					"targets": [5],					
				},
				{
					class: "text-center",
					width: 80,
					"orderable": false, 
					"targets": [6],
					render: function(data, type, row, meta){
						var finished='';
						if ( row['is_finished']==0 ){
							finished = 'disabled';
						}
						return '<button type="button" class="btn btn-primary '+ finished +'" onclick="cetakNota(\''+row['id_mutasi']+'\')">'+
									'<i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print'+
								'</button>';
					}
				}
			],
		});

		$.fn.dataTable.ext.search.push(
		    function( settings, data, dataIndex ) {

				var store = $('#select_store').val();
				var barang = data[4] || '';
				var tgl = Date.parse(data[5] || '');
				var inputBarang = $('#cari').val();
				var dari = Date.parse($('#dari').val().split("/").reverse().join("-")) || '0000000000000';
				var sampai = Date.parse($('#sampai').val().split("/").reverse().join("-")+' 23:59:59') || '9999999999999';

		        if (
					barang.includes(store) && (tgl >= dari && tgl <= sampai)
			 	)
		        {
		            return true;
		        }
		        return false;
		    }
		);

		$('#select_store').change(function(event) {
			tableLaporan.draw();
		});

		$('#dari').change(function(event) {
			tableLaporan.draw();
		});

		$('#sampai').change(function(event) {
			tableLaporan.draw();
		});

		$('#dari').on('keyup', function(event) {
			tableLaporan.draw();
		});

		$('#sampai').on('keyup', function(event) {
			tableLaporan.draw();
		});

		$('#ref').click(function(event) {
			tableLaporan.draw();
		});

		tableLaporan.draw();
	});

    function cetakNota(id_mutasi) {
		swal({
			title: "Cetak nota distribusi barang ini?",
			icon: "warning",
			buttons: true,
		}).then((willDelete) => {
			if (willDelete) {
				window.open("<?=url('cetak/print/nota-distribusi/'); ?>"+id_mutasi, '_blank');
			}else{
				return false;
			}
		});
    }
</script>

@endsection