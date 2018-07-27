<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function index(Request $request)
    {
        return view('auth.register');
    }

    public function registeruser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required|confirmed',
//            'confirmation' => 'required|same:password',
        ]);

        $user = new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password = sha1($request->password);
        //$user->password = Hash::make($request->password);
        $user->save();
        return redirect('/login')->with('alert-success','Kamu berhasil Register');
    }

}
