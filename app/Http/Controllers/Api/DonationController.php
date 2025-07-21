<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\DonationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class DonationController extends Controller
{
    public function createDonationRequest(Request $request)
{
 


    $data = $request->validate([
        'patient_name'     => 'required|string|max:255',
        'patient_age'      => 'required|integer|min:0',
        'blood_type_id'    => 'required|exists:blood_types,id',
        'bags_num'         => 'required|integer|min:1',
        'hospital_name'    => 'required|string|max:255',
        'hospital_address' => 'required|string|max:500',
        'city_id'          => 'required|exists:cities,id',
        'phone'            => ['required', 'string', 'max:20', 'regex:/^\+?[0-9]{7,15}$/'],
        'notes'            => 'nullable|string',
        'latitude'         => 'nullable|numeric|between:-90,90',
        'longitude'        => 'nullable|numeric|between:-180,180',
    ]);
            

    $data['client_id'] = $request->user()->id;
  Log::info('Current User: ' . json_encode($request->user()));
 
    $donationRequest = DonationRequest::create( $data);


$clientsID = $donationRequest->city->governorate->clients()
    ->whereHas('bloodTypes', function ($q) use ($request , $donationRequest) {
        $q->where('blood_types.id', $donationRequest->blood_type_id);
    })->where('is_active', 1)
      ->where('clients.id', '!=', $request->user()->id) 
      ->pluck('clients.id')
      ->toArray();
 

       if (!empty($clientsID)) {
        $notificationService = new \App\Services\NotificationService();
        $notificationService->sendDonationRequestNotifications($donationRequest, $clientsID);
    }

 
    return response()->json([
        'status' => 200,
        'message' => 'تم إنشاء طلب التبرع وإرسال الإشعارات بنجاح',
        'donation_request' => $donationRequest,
        'notifications_sent' => count($clientsID)
    ]);
}
public function getDonationRequests(Request $request)
{
  
    $client = $request->user();
 
    $donationRequests = DonationRequest::all();

    return response()->json([
        'status' => 200,
        'message' => 'تم جلب طلبات التبرع بنجاح',
        'data' => $donationRequests
    ]);
}

public function showDonationRequest($id, Request $request)
{
    $client = $request->user(); 

    $donationRequest = DonationRequest::where('id', $id)
                                      ->with('bloodType') 
                                      ->first();

    if (!$donationRequest) {
        return response()->json([
            'status' => 404,
            'message' => 'طلب التبرع غير موجود أو ليس لديك صلاحية للوصول إليه.',
        ], 404);
    }

    return response()->json([
        'status' => 200,
        'message' => 'تم جلب طلب التبرع بنجاح',
        'data' => $donationRequest
    ]);
}


}
