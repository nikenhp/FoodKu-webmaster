<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index(Request $request)
    {
        return view("auth.login");
    }

    public function userviewAll(Request $request, $id)
    {
        return User::all();
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = sha1($request->input('password'));

        $activeUser = User::where([
            'email'=>$email,
            'password'=>$password
            ])->first();

        if(is_null($activeUser))
        {
            return "<div class='alert alert-danger'>Pengguna Tidak Ditemukan!</div>";
        }
        else
        {
            if($activeUser->password != $password)
            {
                return "<div class='alert alert-danger'>Password Salah!</div>";
            }
            else
            {
                $request->session()->put('activeUser', $activeUser);
                return redirect("/home");
                //return view("/home");
            }
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');

    }


    /*public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }*/
}
