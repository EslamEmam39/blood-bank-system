<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
   
        public function login(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'phone'    => 'required',
                'password' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            $client = Client::where('phone', $request->phone)->first();
    
            if (! $client || ! Hash::check($request->password, $client->password)) {
                return response()->json(['message' => 'Phone or password is incorrect'], 401);
            }
    
            $token = $client->createToken('client-token')->plainTextToken;
    
            return response()->json([
                'data'    => 200,
                'message' => 'Login successful',
                'token'   => $token,
               
            ],200);
        }
}
