<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'               => 'required|string|max:255',
            'email'              => 'required|email|unique:clients,email',
            'birth_date'         => 'required|date|before:today',
            'city_id'            => 'required|integer|exists:cities,id',
            'phone'              => 'required|string|max:20|unique:clients,phone',
            'donation_last_date' => 'nullable|date|before_or_equal:today',
            'password'           => 'required|string|min:6|confirmed',   
            'blood_type_id'      => 'required|integer|exists:blood_types,id',
            'is_active'          => 'boolean',
            'api_token'          => 'nullable|string|unique:clients,api_token',
            'pin_code'           => 'nullable|string|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
            
        $client = Client::create([
            'name'               => $request->name,
            'email'              => $request->email,
            'phone'              => $request->phone,
            'birth_date'         => $request->birth_date,          
            'blood_type_id'      => $request->blood_type_id,
            'city_id'            => $request->city_id,
            'donation_last_date' => $request->donation_last_date,      
            'password'           => Hash::make($request->password),
            'pin_code'           => $request->pin_code,
            'is_active'          => true,          

        ]);



        $token = $client->createToken('client-token')->plainTextToken;

        $client->governorates()->attach($client->city->governorate_id);
        $client->bloodTypes()->attach($request->blood_type_id);

        return response()->json([
            'message' => 'Account created successfully',
            'token'   => $token,
            'client'  => $client
        ]);
    }
        
}
