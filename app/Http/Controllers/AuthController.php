<?php

namespace App\Http\Controllers;

use App\Helpers\Wizard;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use Wizard;

    /**
     * Authenticate user with credentials
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            $input = $request->validated();

            $credentials = [
                'email'    => $input['email'],
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

        } catch (\Throwable $error) {
            $className = (new \ReflectionClass(get_class()))->getShortName();
            self::createLog($className,$error);
            return response()->json(['error' => 'Erro interno do servidor.'], 500);
        }
    }
}
