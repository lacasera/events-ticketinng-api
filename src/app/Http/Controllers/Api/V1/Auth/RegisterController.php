<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\RegisterController  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create(
            $request->only([
                'email',
                'password',
                'phone',
                'device_token',
                'device_type'
            ])
        );

        $token = $user->createToken('token')->plainTextToken;

        //send event to verify phone number

        return response()->json([
            'data' => compact('user', 'token')
        ], 201);
    }
}
