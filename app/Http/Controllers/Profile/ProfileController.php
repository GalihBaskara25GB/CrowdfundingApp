<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResources;
use App\Models\User;
use App\Http\Requests\Profile\UpdateProfileRequest;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return response()->json([
            'response_code' => '00',
            'response_message' => 'profile berhasil di tampilkan',
            'data' => Auth::user()->toArray(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        $photoName = auth::user()->getKey().'.'.$request->foto->extension();
        $photoPath = '/public/image/user/';
        $name = request('name');

        if(!$uploadPhoto = $request->foto->move(public_path($photoPath), $photoName)) {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Gagal mengupload data',
            ]);
        };

        $user = Auth::user();
        $upfateUser = $user->update([
            'name' => $name,
            'foto' => $photoPath.$photoName
            ]);
        
        if($updateUser) {
            return response()->json([
                'response_code' => '00',
                'response_message' => 'profile berhasil di tampilkan',
                'data' => $user->toArray(),
            ]);
        } else {
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Gagal mengupdate data',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
