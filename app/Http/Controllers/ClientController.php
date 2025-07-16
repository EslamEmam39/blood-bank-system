<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();
 
    if ($request->has('name') && $request->name != '') {
        $query->where('name', 'LIKE', '%' . $request->name . '%');
     }

     if($request->has('email') && $request->email != ''){
        $query->where('email' , 'LIKE' , '%' . $request->email .'%');
     }



    if ($request->has('is_active') && $request->is_active != '') {
        $query->where('is_active', $request->is_active);
    }

    $clients = $query->paginate(10);
    return view('clients.index', compact('clients'));
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
        //
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
        Client::findOrFail($id)->delete();

        return redirect()->route('clients.index')->with('success' , 'تم حذف المتبرع');
    }

    public function toggle($id)
{
    $client = Client::findOrFail($id);
    $client->is_active = !$client->is_active;
    $client->save();

    return redirect()->route('clients.index')->with('success', 'تم تغيير الحالة');
}

}
