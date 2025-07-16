<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
          
            'pin_code' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $client = Client::where('pin_code', $request->pin_code)->first();
                 
                        

        if (! $client) {
            return response()->json([
                'message' => 'الكود غير صحيح أو رقم الهاتف غير مطابق'
            ], 422);
        }

        $client->password = Hash::make($request->password);
        $client->pin_code = null; 
        $client->save();

        return response()->json([
            'message' => 'تم تغيير كلمة المرور بنجاح'
        ]);
    }
}
