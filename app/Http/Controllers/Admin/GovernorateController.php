<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governorates = Governorate::latest()->paginate(10);
        return view('admin.governorates.index', compact('governorates'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
                return view('admin.governorates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


         $request->validate([
            'name' => 'required|unique:governorates,name'
        ]);

        Governorate::create($request->all());

        return redirect()->route('governorates.index')->with('success', 'تمت الإضافة');
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
        $governorate = Governorate::findOrFail($id);
        return view('admin.governorates.edit' , compact('governorate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $governorate = Governorate::findOrFail($id);

         $request->validate([
            'name' => 'required|unique:governorates,name,' . $governorate->id
        ]);

        $governorate->update($request->all());

        return redirect()->route('governorates.index')->with('success', 'تم التعديل');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
             Governorate::findOrFail($id)->delete();
         return redirect()->route('governorates.index')->with('success', 'تم الحذف');
    
    }
}
