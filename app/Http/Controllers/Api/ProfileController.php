<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
 
    public function show(Request $request)
    {
        $client = $request->user();

        return response()->json([
            'data' => $client->only([
                'name', 'email', 'd_o_b', 'blood_type_id',
                'Last_date_of_donation', 'city_id', 'phone'
            ])
        ]);
    }

    // تعديل البيانات
    public function update(Request $request)
    {
        $client = $request->user();

        $validated = $request->validate([
            'name'                  => 'sometimes|string|max:255',
            'email'                 => 'sometimes|email|unique:clients,email,' . $client->id,
            'd_o_b'                 => 'sometimes|date',
            'blood_type_id'         => 'sometimes|exists:blood_types,id',
            'Last_date_of_donation' => 'sometimes|date|nullable',
            'city_id'               => 'sometimes|exists:cities,id',
            'phone'                 => 'sometimes|string|max:20',
            'password'              => 'sometimes|string|min:6|confirmed',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }else{
                        unset($validated['password']);

        }

        $client->update($validated);

          return response()->json([
            'message' => 'تم تحديث بيانات المستخدم بنجاح',
            'client' => $client,
        ]);  
      }

public function getNotificationSettings(Request $request){

    $client= $request->user()->load('bloodTypes' , 'governorates'); 

    return response()->json([
       'status'    => 200 ,
       'message'   =>  'تم جلب الاشعارات ' ,
       'client'    => $client
    ]);
      
     
 }// end


    public function updateNotificationSettings(Request $request){

    $client = $request->user(); 

   $data = $request->validate([
        'blood_types' => 'array|exists:blood_types,id',
        'governorates' => 'array|exists:governorates,id',
    ]);


  if(isset($data['blood_types'])){
    $client->bloodTypes()->sync($data['blood_types']);

  }
    if(isset($data['governorates'])){
     $client->governorates()->sync($data['governorates']);

    }
 
    return response()->json([
        'status' => 200,
        'message' => 'تم تحديث إعدادات الإشعارات بنجاح',
    ]);
}// end
}
