<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blood_type;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 

class DonationRequestController extends Controller
{
    public function index(Request $request){

       $bloodTypys = Blood_type::all();
        $cities = City::all() ; 
         
        $donationRequest = DonationRequest::filter($request->only('city' , 'bloodTypy'))
        ->orderBy('id' , 'desc')
        ->paginate(5);

        return view('front.donations.index' , compact('donationRequest' ,'bloodTypys' ,'cities'));
    } 


public function create(){


      $cities = City::all() ; 
      $bloodTypys = Blood_type::all(); 
        return view('front.donations.create' , compact('cities', 'bloodTypys'));
}
    public function store(Request $request) {

         $request->validate([
            'patient_name' => 'required|string',
            'patient_age' => 'required|numeric|min:1',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required|numeric|min:1',
            'hospital_name' => 'required|string',
            'hospital_address' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required|string',
            'notes' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);



        $donationRequest = DonationRequest::create([
            'client_id'        => Auth::guard('client')->id(), 
            'patient_name'     => $request->patient_name,
            'patient_age'      => $request->patient_age,
            'blood_type_id'    => $request->blood_type_id,
            'bags_num'         => $request->bags_num,
            'hospital_name'    => $request->hospital_name,
            'hospital_address' => $request->hospital_address,
            'city_id'          => $request->city_id,
            'phone'            => $request->phone,
            'notes'            => $request->notes,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
        ]);

        
          $clientsID = $donationRequest->city->governorate->clients()
           ->whereHas('bloodType' , function($q)  use($request , $donationRequest) {
            $q->where('blood_types.id' , $donationRequest->blood_type_id);
           })->where('clients.id', '!=', Auth::guard('client')->id())
           ->where('is_active' , 1)
           ->pluck('clients.id')
           ->toArray();       
          ;

           if(empty($clientsID)){

                return redirect()->back()->with('info', 'تم إنشاء الطلب، ولكن لا يوجد متبرعين حالياً بنفس الفصيلة في نفس المحافظة.');
           }else{

                 $notificationsService =  new \App\Services\NotificationService();
                 $notificationsService->sendDonationRequestNotifications($donationRequest, $clientsID);
                return redirect()->back()->with('success', 'تم إنشاء طلب التبرع وإرسال الإشعارات للمتبرعين.');

           }
             
    }


    public function show($id)
    {
        $donationRequest = DonationRequest::find($id);
        return view('front.donations.show', compact('donationRequest'));
    }

}
