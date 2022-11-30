<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $credentials = $request->only(['username', 'password']);

            if(!$token = Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Usuário ou senha estão incorretos!'
                ], 401);
            }

            return $this->respondWithToken($token);
        }
        catch(Exception $e) {
            return response()->json([
                'message' => 'Não foi possível fazer o login!'
            ], 400);
        }
    }


    public function register(Request $request)
    {
        try {
            if(strlen($request->name) < 6) {
                return response()->json([
                    'message' => 'O nome deve ter no minino 6 digitos!'
                ], 400);
            }

            if(strlen($request->username) < 5) {
                return response()->json([
                    'message' => 'O username deve ter no minino 5 digitos!'
                ], 400);
            }

            if(!is_null(User::where('username', $request->username)->first())) {
                return response()->json([
                    'message' => 'Já existe um usuário com este username'
                ], 400);
            }

            if(strlen($request->password) < 3) {
                return response()->json([
                    'message' => 'A senha deve ter no minino 3 digitos!'
                ], 400);
            }

            $user = new User();
            $user->username = mb_strtolower($request->username);
            $user->name = mb_strtoupper($request->name);
            $user->password = Hash::make($request->password);
            $user->save();

            return $this->login($request);
        }
        catch(Exception $e) {
            return response()->json([
                'message' => 'Não foi possível fazer o cadastro!'
            ], 400);
        }
    }


    public function me()
    {
        return response()->json([
            auth()->user()
        ], 200);
    }


    public function logout()
    {
        try {
            Auth::logout();
            return response()->json([
                'message' => 'Deslogado com sucesso!'
            ], 200);
        }
        catch(Exception $e) {
            return response()->json([
                'message' => 'Não foi possível deslogar!'
            ], 400);
        }

    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ]);
    }
}
