<?php

namespace App\Http\Controllers;

use DB;
use Validator;
use DataTables;
use Carbon\Carbon;
use App\Models\ViewMenu;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
   	public function index()
    {    	
        return view('database.menu.menu');
    }

    public function get_datatable()
    {
        $model = ViewMenu::select([
        	'id',
            'nama_menu',
            'harga',
            'gambar',   
            'category',
            'deskripsi',         
        ]);

        $dt = DataTables::of($model);
        return $dt->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$data = [
    		'kategori' => DB::table('category')->get()
    	];

        return view('database.menu.insert', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    	
    	if ( $request->file("gambar") ){
            $time = Carbon::now();
            $extension = $request->file("gambar")->getClientOriginalExtension();
            $directory = 'barang/';
            $filename = str_slug($request->input('nama_menu')).'-'.date_format($time,'d').rand(1,999).date_format($time,'h').".".$extension;
            $upload_success = $request->file("gambar")->storeAs($directory, $filename, 'public');
        } else {
            $filename = '';
        }

        Validator::make($request->only(['nama_menu', 'harga', 'kategori', 'gambar', 'deskripsi']), [
            'nama_menu' => 'required',
            'harga' => 'required',
            'kategori' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'deskripsi'
        ]);

        $object = [
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'id_category' => $request->kategori,
            'gambar' => $filename,
            'deskripsi' => $request->deskripsi,
        ];
    
        if (Menu::create($object)){
            return redirect('database/menu');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'menu' => Menu::find($id),
            'kategori' => DB::table('category')->get()
        ];

        return view('database.menu.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    	$object = [
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'id_category' => $request->kategori,            
            'deskripsi' => $request->deskripsi,
        ];

        Validator::make($object, [
            'nama_menu' => 'required',
            'harga' => 'required',
            'id_category' => 'required',            
            'deskripsi' => 'required',
        ]);

        if (Menu::find($id)->update($object)){
            return redirect('database/menu');
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Menu::destroy($id)){
            return redirect('database/menu');
        }
    }
}
