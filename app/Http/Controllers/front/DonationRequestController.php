<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Blood_type;
use App\Models\City;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationRequestController extends Controller
{
    public function index(Request $request){

       $bloodTypys = Blood_type::all();
        $cities = City::all() ; 
         
        $donationRequest = DonationRequest::filter($request->only('city' , 'bloodTypy'))
        ->orderBy('id' , 'desc')
        ->paginate(5);

        return view('front.donation-request' , compact('donationRequest' ,'bloodTypys' ,'cities'));
    } 
}
