<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->only('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()
            ], 422);
        }

        $token = JWTAuth::attempt($request->only('email', 'password'));

        if($token) {
            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => Auth::user()
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Unauthorized'
            ], 401);
        }
    }

    public function registro(ResgistroRequest $request)
    {
            $user = new User();
            $user -> name = $request ->name;
            $user -> email = $request ->email;
            $user->password = bcrypt($request ->password);
            $user->save();

            $user->roles()->attach($request->roles);

            return response()->json([
                'res'=> true,
                'msg'=>'Usuario Registrado Correctamente'
            ],200);

    
    }

    public function logout() {
        $token = JWTAuth::getToken();
        try {
            JWTAuth::invalidate($token);
            return response()->json([
                'success' => true
            ], 200);
        } catch(JWTException $ex) {
            return response()->json([
                'success' => false,
                'error' => 'Failed logout'
            ], 422);
        }
    }
}