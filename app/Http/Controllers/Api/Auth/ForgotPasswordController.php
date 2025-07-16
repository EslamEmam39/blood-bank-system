<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function sendCode(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:clients,phone'
        ]);

        $client = Client::where('phone', $request->phone)->first();

 
        $pin = rand(1000, 9999);

    
        $client->pin_code = $pin;
        $client->save();

        // هنا تقدر تبعته SMS (أو ترجعه مؤقتًا للتجربة)
        return response()->json([
            'message' => 'تم إرسال كود التحقق',
            'pin_code' => $pin // فقط للـ testing، متشيلهاش في الإنتاج
        ]);
    }
}
