<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\VerificationRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Otp_code;

class VerificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(VerificationRequest $request)
    {
        $otpCode = Otp_code::where('otp_code', $request->otp_code)->first();
        if(!$otpCode) {
            $responseCode = '01';
            $responseMessage = 'OTP Code tidak ditemukan';
            $data[] = [];

        } elseif(Carbon::now() > $otpCode->valid_until) {
            $responseCode = '01';
            $responseMessage = 'OTP Code sudah kadaluarsa, silahkan regenerate ulang';
            $data[] = [];
            
        } else {   
            $user = User::find($otpCode->user_id);
            $user->email_verified_at = Carbon::now();
            $user->save();
            $otpCode->delete();
            $data['user'] = $user;

            $responseCode = '00';
            $responseMessage = 'OTP telah diterima, silahkan masukkan password anda';
        }

        return response()->json([
            'response_code' => $responseCode,
            'response_message' => $responseMessage,
            'data' => $data,
        ]);

    }
}
