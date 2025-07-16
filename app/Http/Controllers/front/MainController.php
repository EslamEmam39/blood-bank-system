<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Blood_type;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\DonationRequest;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index(Request $request)
    
    {

        $articles = Article::latest()->paginate(9);
        $bloodTypys = Blood_type::all();
        $cities = City::all() ; 
    
   $donations = DonationRequest::filter($request->only('bloodTypy', 'city'))
    ->orderBy('id', 'desc')
    ->paginate(10);


    //   dd($request->all());

         
        return view('front.home' , compact('articles' , 'bloodTypys' ,'cities' ,'donations'));
    }

    public function about(){

        return view('front.about');
    }

    public function editProfile()
{
    $client = auth()->guard('client')->user();
    $bloodTypies = Blood_type::all();
    $governorates = Governorate::all();
    return view('front.profile', compact('client' ,'bloodTypies' ,'governorates'));
}

public function updateProfile(Request $request){

        $client = auth()->guard('client')->user();

    $request->validate([
        'name'               => 'required|string|max:255',
        'email'              => 'required|email|unique:clients,email,' . $client->id,
        'birth_date'         => 'nullable|date',
        'blood_type_id'      => 'required|exists:blood_types,id',
        'governorate_id'     => 'required|exists:governorates,id',
        'city_id'            => 'required|exists:cities,id',
        'phone'              => 'required|string|max:20',
        'donation_last_date' => 'nullable|date',
        'password'           => 'nullable|confirmed|min:6',
    ]);

    
    $data = $request->only([
        'name',
        'email',
        'birth_date',
        'blood_type_id',
        'governorate_id',
        'city_id',
        'phone',
        'donation_last_date'
    ]);

  
    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $client->update($data);

    return back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
}

    public function getContactUs(){

        return view('front.contact-us');
    }

     public function storeContactUs(Request $request){

        $clientId  = auth()->guard('client')->user()->id;

        // dd($clientId );
          $request->validate([
              'title'   => 'required|string|max:255',
              'message' => 'required|string|max:1000',
            
        ]);

        ContactUs::create([
            'title' => $request->title , 
            'message' => $request->message , 
            'client_id' => $clientId  , 
        ]) ; 

    
        return back()->with('success' , 'تم ارسال رسالتك بنجاح');


    }
}
