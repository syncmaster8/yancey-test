<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username'  => 'string|required',
                'password'  => 'string|required'
            ]);

            if ($validator->fails()) {
                return response()->json(['Requirements' => $validator->errors()]);
            }
        
            $credentials = $request->only('username', 'password');

            \DB::beginTransaction();

            if (auth()->attempt($credentials)) {

                $token = auth()->user()->createToken('auth_token');
                
                $user = auth()->user();

                $usertype = $user->usertype;

                $store = $user->store;
            
                $response = [
                    "access_token" => $token->accessToken,
                    "name" => $user->name,
                    "username" => $user->username,
                    "type" =>  $usertype->name,
                    "store" =>  $store->store_name ?? null,
                    "created_at" => $user->created_at,
                    "updated_at" => $user->updated_at
                ];
                
                \DB::commit();

                return response()->json(['Login Successful' => $response]);
            } else {
                return response()->json(['Username or Password is incorrect!' => $request->all()]);
            } 

        } catch ( Exception $e) {
            \DB::rollBack();
            
            return response()->json(['Error']);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();
        
        return response()->json(['Logout Successful']);
    }
}
