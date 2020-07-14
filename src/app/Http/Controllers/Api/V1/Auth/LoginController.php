<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();

        throw_if(

            !$user || ! Hash::check($request->password, $user->password),
        
            ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ])
        );


        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'data' => compact('user', 'token')
        ], 200);
    }

    
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'data' => 'user logged out successfully'
        ], 200);
    }
}
