<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blood_type;
use App\Models\Client;
use App\Models\Governorate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm(){
       
        return view('front.Auth.login');
      }


      public function login(Request $request){

        // dd($request->all());

        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

          $credentials = $request->only('phone', 'password');
            if(Auth::guard('client')->attempt($credentials)){
              return redirect()->intended('/');
              }

              return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);

      } // end 


      public function showRegisterForm(){
        $governorates =Governorate::all();
        $bloodTypies = Blood_type::all();
        return view('front.Auth.register' ,compact('governorates' , 'bloodTypies') );
      }


       public function register(Request $request){

 
        // dd($request->all());
         $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
            'birth_date' => 'required|date',
            'phone' => 'required|unique:clients,phone',
            'password' => 'required|confirmed|min:6',
            'city_id' => 'required|exists:cities,id',
            'blood_type_id' => 'required',
            'donation_last_date' => 'nullable|date',
        ]);

$birthDate = Carbon::parse($request->birth_date)->format('Y-m-d');
$donationDate = Carbon::parse($request->donation_last_date)->format('Y-m-d');

          $client = Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'birth_date' => $birthDate,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'city_id' => $request->city_id,
            'blood_type_id' => $request->blood_type_id,
            'donation_last_date' => $donationDate,
            'is_active' => true,
        ]);

    $client->assignRole('client') ;  

    $client->governorates()->attach($client->city->governorate_id  );
    $client->bloodTypes()->attach(     $request->blood_type_id);
        
        Auth::guard('client')->login($client);

                return redirect()->route('/'); 

       }



 public function logout(Request $request)
    {
      Auth::guard('client')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('client.login'); 
    }


    public function showForgotForm(   )
    {
          return view('front.Auth.password.forgot');
    }
 

    public function sendPin(Request $request)
    {
          $request->validate(['phone' => 'required|exists:clients,phone']);

              $client = Client::where('phone', $request->phone)->first();

                 $code = rand(1000, 9999);

                 $client->pin_code = $code;
                  $client->save();


                  

           return redirect()->route('client.password.verify')->with('success', "كود الاسترجاع هو: $code");
      }

      public function showVerifyForm(){
        return view('front.Auth.password.verify');
      }

      public function reset(Request $request)
{
    $request->validate([
        'phone' => 'required',
        'pin_code' => 'required',
        'password' => 'required|confirmed|min:6',
    ]);

    $client = Client::where('phone', $request->phone)
                    ->where('pin_code', $request->pin_code)
                    ->first();

    if (!$client) {
        return back()->with('error', 'كود غير صحيح أو منتهي الصلاحية');
    }

    $client->update([
        'password' => Hash::make($request->password),
        'pin_code' => null,
    ]);

    return redirect()->route('client.login')->with('success', 'تم تغيير كلمة المرور بنجاح');
}

}
