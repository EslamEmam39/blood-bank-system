<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Client;
use App\Models\ContactUs;
use App\Models\DonationRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
        public function index()
    {
        $requestDonations = DonationRequest::all();
        $articles = Article::all();
        $clients = Client::all();
        $contactUs = ContactUs::all();
        return view('admin.dashboard' , compact('requestDonations' , 'articles' , 'clients' ,'contactUs'));
    }
}
