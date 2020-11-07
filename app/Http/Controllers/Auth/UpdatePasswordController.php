<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdatePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Otp_code;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdatePasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            $responseCode = '01';
            $responseMessage = 'Email tidak ditemukan';
            $data[] = [];

        } elseif(!$user->isEmailVerified()) {
            $responseCode = '01';
            $responseMessage = 'Email yang anda masukkan belum diverifikasi';
            $data[] = [];
            
        } else {
            $user->password = Hash::make(request('password')); 
            $user->save();     
            $data['user'] = $user->toArray();

            $responseCode = '00';
            $responseMessage = 'Password berhasil diubah';
        }

        return response()->json([
            'response_code' => $responseCode,
            'response_message' => $responseMessage,
            'data' => $data,
        ]);
    }
}
