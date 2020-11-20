<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function random($count) 
    {
        $campaigns = Campaign::select("*")
                                ->inRandomOrder()
                                ->limit($count)
                                ->get();
        $data['campaigns'] = $campaigns;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'Data successfully loaded',
            'data' => $data
        ], 200);
    }

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
        $request->validate([
            'title'=> 'required',
            'description'=> 'required',
            'image'=> 'required|mimes:jpeg,jpg,png',
        ]);

        $campaign = Campaign::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if($request->hasFile('image')) {
            $photoName = $campaign->id.'.'.$request->image->extension();
            $photoPath = 'public/image/campaign/';

            if(!$uploadPhoto = $request->image->move(public_path($photoPath), $photoName)) {
                return response()->json([
                    'response_code' => '01',
                    'response_message' => 'Failed to upload image',
                ]);
            }

            $campaign->update([
                'image' => $photoPath.$photoName
            ]);
        }

        $data['campaign'] = $campaign;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'Campaign data successfully saved',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
