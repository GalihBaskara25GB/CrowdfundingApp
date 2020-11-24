<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if(!is_null($user) && !$user->isEmailVerified()) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Email yang anda masukkan belum diverifikasi'
            ]);

        }

        if(! $token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Invalid Email or Password !'], 401);
        }

        return response()->json([
            'response_code' => '00',
            'response_message' => 'user berhasil login',
            'data' => [
                'token' => $token,
                'user' => $user->toArray(),
            ],
        ]);

        return response()->json(compact('token'));
    }
}
