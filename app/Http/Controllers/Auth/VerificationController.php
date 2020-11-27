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
            $responseMessage = 'OTP Code not Found !';
            $data[] = [];

        } elseif(Carbon::now() > $otpCode->valid_until) {
            $responseCode = '01';
            $responseMessage = 'OTP Code has expired, please regenerate OTP Code !';
            $data[] = [];
            
        } else {   
            $user = User::find($otpCode->user_id);
            $user->email_verified_at = Carbon::now();
            $user->save();
            $otpCode->delete();
            $data['user'] = $user;

            $responseCode = '00';
            $responseMessage = 'OTP has been verified, Update Your Password';
        }

        return response()->json([
            'response_code' => $responseCode,
            'response_message' => $responseMessage,
            'data' => $data,
        ]);

    }
}
