<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    
    public function register(Request $request){
        $validation = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required',
            'c_password'=>'required|same:password',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors(),202);
        }
        $allData = $request->all();
        $allData['password'] = Hash::make($allData['password']);

        $user = User::create($allData);
        Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ]);
        
        $reArr['token'] = $user->createToken('api-application')->accessToken;

        return response()->json($reArr,200);
    }

    public function login(Request $request){

        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ])){
            $user = Auth::user();
            $reArr['token'] = $user->createToken('api-application')->accessToken;
            return response()->json($reArr,200);
        }else{
            return Response()->json(['error'=>'Unauthorize User'],203);
        }

    }
}
