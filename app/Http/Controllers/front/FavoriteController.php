<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{

    public function index()
    {
        $client = auth()->guard('client')->user();
        $favorites = $client->favorites()->get();
        //   dd($favorites) ;
        return view('front.favorites-list',compact('favorites'));

       
        // $favorites = $client->favorites()->get();
        // return view('front.favorites.index',compact('favorites'));
    }
    public function add($articleId){

        $client = auth()->guard('client')->user();
         $client->favorites()->attach($articleId);
         return back()->with('success', 'تم الأضافة إلى المفضله بنجاح');
          
    }

    public function remove($articleId){
     
        $client = auth()->guard('client')->user();
        $client->favorites()->detach($articleId);
        return back()->with('success','تم الحذف من المفضله بنجاح');
    }
}
