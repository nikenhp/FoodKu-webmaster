<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	DB::table('ordermenu')->where('is_finished', 0)->update([
    		'is_fetched' => 1
    	]);

    	$data = [
    		'order' => DB::table('ordermenu')->where('is_finished', 0)->get()
    	];

        return view('database.order.index', $data);
    }

    public function get_datatable()
    {
        $model = User::select([
            'id',
            'name',
            'email',            
        ]);

        $dt = DataTables::of($model);
        return $dt->make(true);
    }

    public function fetch_data()
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    	DB::table('ordermenu')->where('id', $request->id)->update([
    		'is_finished' => 1
    	]);

    	return response()->json([
    		'status' => 'Order berhasil diselesaikan',    		
    	]);
    }
}
