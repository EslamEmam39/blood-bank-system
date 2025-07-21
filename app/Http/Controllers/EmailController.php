<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function welcomeEmail(){

        Mail::to('recipent@example.com')->send( new WelcomeMail());

        return  'send successfilly' ;
    }
 }
