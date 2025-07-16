<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_app', 'phone', 'whatsapp', 'youtube_url', 'email', 
        'instagram_url', 'facebook_url', 'twitter_url' , 'google_url',
    ];
}
