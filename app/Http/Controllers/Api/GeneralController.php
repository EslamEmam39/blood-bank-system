<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blood_type;
use App\Models\Category;
use App\Models\City;
use App\Models\ContactUs;
use App\Models\Governorate;
use App\Models\setting;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

    private function apiResourse ( $status, $message  ,$data=null)  {

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
            ]);

    }

    public function categories ()
    {
              $categories = Category::all();
            return $this->apiResourse(200 , 'success' , $categories);


    }//End
        public function bloodTypes()
        {
            $bloodTypes = Blood_type::all();
            return $this->apiResourse(200 , 'success' , $bloodTypes);


        }//End

       public function cities(Request $request)
{
    $cities = City::when($request->governorate_id, function ($query, $governorate_id) {
        $query->where('governorate_id', $governorate_id);
    })->get();

    return $this->apiResourse(200, 'success', $cities);
}// end


        public function governorates()
         {
            $governorates = Governorate::all();
            return $this->apiResourse(200 , 'success' , $governorates);;
        }//end 


        
        public function getInfo(Request $request){
            $client = $request->user();     

            $setting  = setting::first();

            return response()->json([
                'phone'      => $client->phone,
                'email'      => $client->email,
                'fb_link'    => $setting->fb_link,
                'tw_link'    => $setting->tw_link,
                'insta_link' => $setting->insta_link

            ]);


              
           }// end
public function sendMessage(Request $request)
{
// dd($request->user());

      $data = $request->validate([
        'title'    => 'required',
        'message'   => 'required',
     
           ]);
      
     $data['client_id'] = $request->user()->id;
    //  dd($data-);

 

   
     ContactUs::create($data);

    return response()->json([
        'message' => 'تم استلام رسالتك بنجاح'
    ]);
}// end 

public function about_app(){

    $aboutApp  = setting::first();

    return response()->json([

        'status' => 200,
        'aboutApp' => $aboutApp->about_app 
        
    ]);
}// end

 
public function settings()
{
    $settings = Setting::first();
    return response()->json([
        'settings' => $settings
    ]);
} // end

}
