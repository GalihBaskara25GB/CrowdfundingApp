<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegenerateOtpRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Otp_code;

class RegenerateOtpController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegenerateOtpRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            $responseCode = '01';
            $responseMessage = 'Email tidak ditemukan';
            $data[] = [];

        } elseif($user->email_verified_at != null) {
            $responseCode = '01';
            $responseMessage = 'Email yang anda masukkan sudah terverifikasi, silahkan masukkan email lain';
            $data[] = [];
            
        } else {   
            Otp_code::where('user_id', $user->getKey())->delete();
            $otpCode = Otp_code::create([
                'otp_code' => Str::random(6),
                'user_id' => $user->getKey(),
                'valid_until' => Carbon::now()->addMinutes(5),
            ]);            
            $data['user'] = User::find($user->getKey(), ['name', 'email', 'created_at', 'updated_at', 'id'])->toArray();

            $responseCode = '00';
            $responseMessage = 'Check your email for OTP Code, OTP Code valid until 5 minutes from now';
        }

        return response()->json([
            'response_code' => $responseCode,
            'response_message' => $responseMessage,
            'data' => $data,
        ]);
    }
}
