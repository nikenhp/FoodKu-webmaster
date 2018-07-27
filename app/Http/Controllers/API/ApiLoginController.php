<?php
/**
 * Created by PhpStorm.
 * User: nathanael79
 * Date: 05/06/18
 * Time: 22:16
 */

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiLoginController extends Controller
{
    public function viewAll(Request $request)
    {
        return response()->json([
            "status"=>"berhasil",
            "code"=>"200",
            "data"=>User::all(),
        ]);
    }

    public function create(Request $request)
    {

        if ( $request->email && $request->password ){
            User::create([
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>sha1($request->password)
            ]);

            return response()->json([
                "status"=>true,
                "code"=>200,
            ]);
        } else {
            return response()->json([
                "status"=>"gagal",
                "code"=>500,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        //$user = User::findOrFail($id);
        $user = User::where('id',$id);
        if($user!=null)
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => sha1($request->input('password')),
            ]);

            return response()->json([
                "status"=>"berhasil",
                "code"=>"200",
                "data"=>$user,
            ]);
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            "status"=>"berhasil",
            "code"=>"200",
        ]);
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = sha1($request->password);

        $activeUser = User::where('email',$email)->first();
        if ($activeUser!=null) {
            if ($activeUser->password === $password) {
                $activeUser->save();

                $sendingParams = [
                    'status'=> true,
                    'code' => 200,
                    'description' => 'success',
                    'message' => 'login berhasil',
                    'data' => $activeUser
                ];
                
                return response()-> json($sendingParams);
            }
        }
        
        if(is_null($activeUser)){
           $sendingParams = [
                'code' => 404,
                'description' => 'failed',
                'message' => 'data  tidak ada',
                'data' => $activeUser
            ];
            return response()-> json($sendingParams);
        }
        
       if ($activeUser -> password != $password) {
            $sendingParams = [
                'code' => 404,
                'description' => 'failed',
                'message' => 'password salah'
            ];
            return response()-> json($sendingParams);
        }
    }

}