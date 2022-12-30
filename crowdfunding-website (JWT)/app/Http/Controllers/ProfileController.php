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
}
