<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Otp_code;
use App\Events\UserRegisteredEvent;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            // 'password' => Hash::make(request('password')),
        ]);

        // dd($user->getKey());
        $otpCode = Otp_code::create([
            'otp_code' => Str::random(6),
            'user_id' => $user->getKey(),
            'valid_until' => Carbon::now()->addMinutes(5),
        ]);

        if($user && $otpCode) {
            $responseCode = '00';
            $responseMessage = 'Check your email for OTP Code, OTP Code valid until 5 minutes from now';
            $data['user'] = User::find($user->getKey(), ['name', 'email', 'created_at', 'updated_at', 'id'])->toArray();
            event(new UserRegisteredEvent($user, $otpCode));

        } else {
            $responseCode = '01';
            $responseMessage = 'An Error has Occured';
        }
            
        return response()->json([
            'response_code' => $responseCode,
            'response_message' => $responseMessage,
            'data' => $data
            ]);
        }
}
