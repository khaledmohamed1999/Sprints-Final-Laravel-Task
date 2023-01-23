<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    //
    function login(Request $request)
    {
        if (Auth::attempt($request->post())) {
            $user = Auth::user();
            $user['api_token'] = Str::random(100);
            $user->save();
            return view('/');
        }
        return response()->json('invalide credentials', 403);
    }

    function logout(){
        $user = Auth::user();
        $user['api_token'] = '';
        $user->save();
        return response()->json('Logged out successfully');
    }
}