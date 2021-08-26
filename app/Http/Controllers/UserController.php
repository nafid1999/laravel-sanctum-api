<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function register(Request $request){
          
        $this->validate($request,[
            "name"=>"required",
            "email"=>"required",
            "password"=>"required",
        ]);

        $user=User::Create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
        ]);

        return response()->json($user);

    } 

    public function login(Request $request){
       $user=User::whereEmail($request->email)->first();
       if(isset($user)){
          if(Hash::check($request->password,$user->password)){
              $token=$user->createToken("token")->plainTextToken;
            return response()->json(["message"=>"logged in successfully", "token" =>$token]);

          }
           else
           return response()->json(["message"=>"bad credentials "]);
       }else{
        return response()->json(["message"=>"user not found"]);
       }
    }

    public function users(Request $request){
       
         return response()->json(["data"=>User::all()]);
        
     }


    public function logout(Request $request) {
        
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }


}
