<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class FrontendRegisterController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'provinsi' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'alamatLengkap' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'phoneNumber' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::create([
            'firstName' => $request->firstName,
            'country' => $request->country,
            'nik' => $request->nik,
            'provinsi' => $request->provinsi,
            'email' => $request->email,
            'alamatLengkap' => $request->alamatLengkap,
            // 'password' => Hash::make($request->password),
            'password' => $request->password,
            'phoneNumber' => $request->phoneNumber,
        ]);


        // Generate JWT token
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'));
    }
}
