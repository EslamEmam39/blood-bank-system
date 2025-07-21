<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    return view('admin.clients.index', compact('clients'));
    }

 
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //
    }
 
    public function show(string $id)
    {
        //
    }

 
    public function edit(string $id)
    {
        //
    }

 
    public function update(Request $request, string $id)
    {
        //
    }

 
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
