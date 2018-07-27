@extends('adminlte::page')

@section('title', 'Order List Webmaster')

@section('content')
    <div class="content">
        <section class="content-header">
            <h1>
                Order<br>
                <small style="padding-left: 0">Daftar semua order yang ada</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?= url('dashboard')?>">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-file-text-o"></i> Order
                    </a>
                </li>
            </ol>
        </section>

        <section class="content container-fluid main-content-container">
            <div class="row" id="order-container">
                @foreach ($order as $data)
                    <div class="col-md-12" id="data-order-{{$data->id}}">
                        <div class="box box-primary">
                            <div class="box-header with-border">                                
                                <h3 class="box-title"><b>Order #{{ $data->id }}-{{ $data->tanggal }}</b></h3>
                                <h4>Nama Pelanggan : <b>{{ $data->pelanggan }}</b></h4>
                                <button data-id="{{ $data->id }}" style="float: right; position: absolute; right: 20px; top: 20px;" class="btn btn-danger btn-remove-order">Hapus Order</button>
                            </div>
                            <div class="box-body" style="padding: 10px 30px">
                                <div class="row">
                                    <div class="col-md-12">
                                        @php
                                            $pesanan = DB::table('q_ordermenu_details')->where('id_order', $data->id)->get();
                                        @endphp
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Menu</th>
                                                    <th>Jumlah Pesanan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pesanan as $ps)
                                                    <tr>
                                                        <td>{{ $ps->nama_menu }}</td>
                                                        <td>{{ $ps->kuantitas }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach                
            </div>
        </section>
    </div>

    <script type="text/javascript">

        $(document).on('click', '.btn-remove-order', function() {
            const dis = $(this);
            $.ajax({
                url: '/database/order/delete',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: $(this).attr('data-id')
                },
                success: function(res){
                    console.log("Order berhasil diubah menjadi selesai");
                    dis.parent().parent().parent().fadeOut(300, function(){ $(this).remove();});
                }
            });
        });

        function fetch_data(){
            $.ajax({
                url: '/database/order/fetch_data',
                type: 'GET',
                dataType: 'JSON',                
                success: function(res){
                    $.each(res, function(index, el) {
                    //     $('#order-container').prepend('<div class="col-md-12" id="data-order-{{$data->id}}">'+
                    //     '<div class="box box-primary">'+
                    //         '<div class="box-header with-border">'+
                    //             '<h3 class="box-title"><b>Order #{{ $data->id }}-{{ $data->tanggal }}</b></h3>'+
                    //             '<h4>Nama Pelanggan : <b>{{ $data->pelanggan }}</b></h4>'+
                    //             '<button data-id="{{ $data->id }}" style="float: right; position: absolute; right: 20px; top: 20px;" class="btn btn-danger btn-remove-order">Hapus Order</button>'+
                    //         '</div>'+
                    //         '<div class="box-body" style="padding: 10px 30px">'+
                    //             '<div class="row">'+
                    //                 '<div class="col-md-12">'+                                        
                    //                     '@php'+
                    //                         '$pesanan = DB::table("q_ordermenu_details")->where("id_order", $data->id)->get();'+
                    //                     '@endphp'+
                    //                     '<table class="table table-striped table-bordered">'+
                    //                         '<thead>'+
                    //                             '<tr>'+
                    //                                 '<th>Nama Menu</th>'+
                    //                                 '<th>Jumlah Pesanan</th>'+
                    //                             '</tr>'+
                    //                         '</thead>'+
                    //                         '<tbody>'+
                    //                             '@foreach ($pesanan as $ps)'+
                    //                             '<tr>'+
                    //                                 '<td>{{ $ps->nama_menu }}</td>'+
                    //                                 '<td>{{ $ps->kuantitas }}</td>'+
                    //                             '</tr>'+
                    //                             '@endforeach'+
                    //                         '</tbody>'+
                    //                     '</table>'+
                    //                 '</div>'+
                    //             '</div>'+
                    //         '</div>'+
                    //     '</div>'+
                    // '</div>');
                    });
                }
            });
        }

        fetch_data();

        setInterval(function(){ 
            // fetch_data();
        }, 5000);

    </script>

@endsection