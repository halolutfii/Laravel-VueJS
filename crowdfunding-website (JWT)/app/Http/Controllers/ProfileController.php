<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function me() {
        $data['user'] = Auth() -> user();

        return response()->json([
            'response_code' => '00',
            'response_message' => 'Profile berhasil ditampilkan', 
            'data' => $data
        ]);
    }

    public function updateProfile(Request $request) {
        $user = auth()->user();

        if($request->hasFile('photo_profile')){
            $photo_profile = $request->file('photo_profile');
            $photo_profile_extension = $photo_profile->getClientOriginalExtension();
            $photo_profile_name = Str::slug($user->name, '-').'-'.$user->id.'.'.$photo_profile_extension;
            $photo_profile_folder = '/photo/user/photo-profile';
            $photo_profile_location = $photo_profile_folder . $photo_profile_name;
            try{
                $photo_profile->move(public_patch($photo_profile_folder), $photo_profile_name);
                //code...
                $user->update([
                    'photo_profile' => $photo_profile_location,
                ]);
            }catch (\Throwable $th){
                return response()->json([
                    'response_code' => '01',
                    'response_message' => 'Profile gagal  di upload', 
                    // 'data' => $data
                ],200);
            }
        }

        $user->update([
            'name' => $request->name,
        ]);

        $data['user'] = $user;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'Profile berhasil di update', 
            'data' => $data
        ],200);
    }
}
