<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $cities = City::latest()->paginate(10);
        return view('cities.index', compact('cities'));   
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
   $governorates = Governorate::all();
    return view('cities.create', compact('governorates'));


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'governorate_id' => 'required|exists:governorates,id',
    ]);

    City::create($request->all());

    return redirect()->route('cities.index')->with('success', 'تمت الإضافة بنجاح');
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
         $governorates = Governorate::all();
         $city = City::findOrFail($id);
        return view('cities.edit' , compact('governorates','city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $city = City::findOrFail($id);

         $request->validate([
            'name' => 'required|unique:cities,name,' . $city->id,
             'governorate_id' => 'required|exists:governorates,id'

        ]);

        $city->update($request->all());

        return redirect()->route('cities.index')->with('success', 'تم التعديل');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        City::findOrFail($id)->delete();

        return redirect()->route('cities.index')->with('success', 'تم الحذف');
    }
}
