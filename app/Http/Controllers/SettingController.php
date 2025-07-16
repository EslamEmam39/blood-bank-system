<?php

namespace App\Http\Controllers;

use App\Models\setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
    public function edit()
    {
         $setting = setting::first(); 
        return view('settings.edit', compact('setting'));
     }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request )
    {
      $setting = Setting::first();
      

            $request->validate([
            'phone'              => 'nullable|string',
            'about_app'          => 'nullable|string',
            'email'              => 'nullable|email',
            'whatsapp'           => 'nullable|string',
            'youtube_url'        => 'nullable|url',
            'instagram_url'      => 'nullable|url',
            'facebook_url'       => 'nullable|string',
            'twitter_url'        => 'nullable|string',
            'google_url'         => 'nullable|string',
            ]);
          


            $setting->update($request->only([
                'about_app', 'phone', 'whatsapp', 'youtube_url', 'email', 
                'instagram_url', 'facebook_url', 'twitter_url' , 'google_url'
            ]));

        return redirect()->route('settings.edit')->with('success', 'تم تحديث الإعدادات بنجاح');
    }

      


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
