<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

 
        $query = Client::whereHas('donationRequests');

        if($request->filled('name')){
            $query->where('name' ,  'LIKE' , '%' . $request->name . '%');
        }


        
        $clients = $query->withCount('donationRequests')->paginate(10);
       

        return view('donations.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donations = DonationRequest::where('client_id' , $id)->latest()->get();

        // dd($donations);

        return view('donations.show' , compact('donations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DonationRequest::findOrFail($id)->delete();
        return redirect()->route('donations.index')->with('success' , 'Delete Successfuly');
    }
}
