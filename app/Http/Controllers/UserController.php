<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('database.user.user');
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('database.user.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $object = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => sha1($request->password)
        ];

        Validator::make($object, [
            'name' => 'required',
            'email' => 'required|unique[users.email]',
            'password' => 'required',
        ]);

        if (User::create($object)){
            return redirect('database/user');
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
            'menu' => Menu::find($id)
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
        if ($request->password){
            $object = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => sha1($request->password)
            ];
        } else {
            $object = [
                'name' => $request->name,
                'email' => $request->email,                
            ];
        }   

        Validator::make($object, [
            'name' => 'required',
            'email' => 'required',            
        ]);

        if (User::find($id)->update($object)){
            return redirect('database/user');
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
        if (User::destroy($id)){
            return redirect('database/user');
        }
    }
}
