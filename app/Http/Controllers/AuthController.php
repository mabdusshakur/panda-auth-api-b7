<?php

namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $secret_key = env('JWT_SECRET');

        $payload = [
            'iss' => 'panda-auth-api-b7',
            'iat' => time(),
            'exp' => time() + 3600,
            'user_id' => 1,
        ];

        $encoded_jwt = JWT::encode($payload, $secret_key, 'HS256');

        return response()->json([$encoded_jwt])->cookie('token', $encoded_jwt, 3600);
    }


    public function getProfile(Request $request){
        return response()->json(['You are logged in, and your id is: ' . $request->header('id')]);
    }
}
