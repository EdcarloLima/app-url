<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        /*try {*/
            $input = $request->validated();
            dd($input);
            $credentials = [
                'email' => $input['email'],
                'password' => $input['password']
            ];

            if (!$token = auth()->attempt($credentials)) {
                return response()->json(['error' => 'Não autorizado!'], 401);
            }

            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        /*} catch (\Throwable $error) {
            return response()->json(['error' => 'Erro interno do servidor.'], 500);
        }*/
    }
}
