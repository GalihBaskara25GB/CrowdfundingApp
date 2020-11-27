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
            $responseMessage = 'Email not Found';
            $data[] = [];

        } elseif(!$user->isEmailVerified()) {
            $responseCode = '01';
            $responseMessage = 'Enter a Verified Email';
            $data[] = [];
            
        } else {
            $user->password = Hash::make(request('password')); 
            $user->save();     
            $data['user'] = $user->toArray();

            $responseCode = '00';
            $responseMessage = 'Password Successfully Updated, Registration Success !!';
        }

        return response()->json([
            'response_code' => $responseCode,
            'response_message' => $responseMessage,
            'data' => $data,
        ]);
    }
}
