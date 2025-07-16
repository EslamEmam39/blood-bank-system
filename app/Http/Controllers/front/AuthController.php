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
       
        return view('front.login');
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
        return view('front.register' ,compact('governorates' , 'bloodTypies') );
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

        
        Auth::guard('client')->login($client);

                return redirect()->route('/'); 

       }



 public function logout(Request $request)
    {
      Auth::guard('client')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('client.login'); // ✅ مساره الخاص
    }
}
