<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max: 255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Validation Failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'token' => $token,
            'user' => $user
        ], 201);
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }

        return response()->json([
            'token' => $token,
        ], 201);
    }

    public function Logout(Request $request){
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message'=>'Successfully Logout']);
    }

    public function me(){
        return response()->json(JWTAuth::user());
    }
}
