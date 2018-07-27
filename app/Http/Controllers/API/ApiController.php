<?php
/**
 * Created by PhpStorm.
 * User: nathanael79
 * Date: 05/06/18
 * Time: 22:16
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Order;
use App\DetailOrder;

class ApiController extends Controller
{
    function get_menu_all(Request $request){
        $data = DB::table('menu')->first();

        if (is_null($data)) {
            $params = [
                'code' => 404,
                'status' => 'false',
                'description' => 'Error Null',
                'message' => 'Data Kosong',
            ];

            return response()->json($params);
        }
       
       $dataget = DB::table('menu')->get();
       $datafoto =[];
       foreach ($dataget as $gambar) {
           $datagambar = [
            'gambar' => 'public/images/barang'.$gambar->gambar,
           ];
       }
       $params = [
            'code' => 200,
            'status' => 'true',
            'description' => 'Found',
            'message' => 'Data Ditemukan',
            'menu' => $dataget
       ];
       return response()->json($params);
    }

    function get_menu_where(Request $request){        
        $data = DB::table('menu')->where('id', $request->id)->first();
        return response()->json($data);
    }

    function get_order_all(Request $request){
        $data = DB::table('ordermenu')->first();

        if (is_null($data)) {
            $params = [
                'code' => 404,
                'status' => 'false',
                'description' => 'Error Null',
                'message' => 'Data Kosong',
            ];

            return response()->json($params);
        }
       
       $dataget = DB::table('ordermenu')->get();
       $params = [
            'code' => 200,
            'status' => 'true',
            'description' => 'Found',
            'message' => 'Data Ditemukan',
            'ordermenu' => $dataget
       ];
       return response()->json($params);
    }

    function create_order(Request $request){
        $data = Order::create([
            'id_table' => $request->id_table,
            'tanggal' => date('Y-m-d'),
            'pelanggan' => $request->pelanggan,
            'total' => 0,
            'bayar' => 0,
            'kembalian' => 0
        ]);

        $params = [
            'code' => 200,
            'status' => 'true',
            'description' => 'success',
            'message' => 'Data Berhasil ditambahkan',
            'order' => $data
        ];

        return response()->json($params);
    }

    function add_menu_to_order(Request $request){
        $id_order = $request->id_order;
        $id_menu = $request->id_menu;

        if ($data = DetailOrder::where('id_order', $id_order)->where('id_menu', $id_menu)->first()){
            $kuantitas = $data->kuantitas;
        } else {
            $kuantitas = 0;
        }

        if ( $kuantitas > 0){
            $data = DetailOrder::where('id_order', $id_order)->where('id_menu', $id_menu)->update([
                'kuantitas' => $kuantitas+=$request->kuantitas,            
            ]);
            $data = DetailOrder::where('id_order', $id_order)->where('id_menu', $id_menu)->first();
            return response()->json([
                'code' => 201,
                'message' => 'Jumlah barang berhasil ditambahkan',
                'data' => $data
            ]);
        } else {
            $data = DetailOrder::create([
                'id_order' => $request->id_order,
                'id_menu' => $request->id_menu,
                'kuantitas' => 1,
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Barang baru berhasil dimasukkan ke order',
                'data' => $data
            ]);
        }
    }
}