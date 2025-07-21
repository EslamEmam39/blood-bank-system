<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationsController extends Controller
{
  
    public function index(Request $request)
    {

 
        $query = Client::whereHas('donationRequests');

        if($request->filled('name')){
            $query->where('name' ,  'LIKE' , '%' . $request->name . '%');
        }


        
        $clients = $query->withCount('donationRequests')->paginate(10);
       

        return view('admin.donations.index', compact('clients'));
    }

    public function show(string $id)
    {
        $donations = DonationRequest::where('client_id' , $id)->latest()->get();

        // dd($donations);

        return view('admin.donations.show' , compact('donations'));
    }


    public function destroy(string $clientId)
    {
    $donations = DonationRequest::where('client_id', $clientId)->get();

    foreach ($donations as $donation) {
        foreach ($donation->notifications as $notification) {
        
            $notification->clients()->detach();

       
            $notification->delete();
        }
 
        $donation->delete();
    }

    return redirect()->back()->with('success', 'تم حذف جميع طلبات التبرع بنجاح');
    }
}
