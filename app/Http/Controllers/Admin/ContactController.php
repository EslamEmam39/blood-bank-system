<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query =  ContactUs::query();
       
      if ($request->filled('name')) {
        $query->whereHas('client', function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->name . '%');
        });
    }

        $messages  = $query->latest()->paginate(10) ;
        return view('admin.Contact.index' , compact('messages'));
        
    }
 
    public function destroy(string $id)
    {
       $data = ContactUs::findOrFail($id)->delete();

       return redirect()->route('contact.index')->with('success' , 'good');
    }
}
