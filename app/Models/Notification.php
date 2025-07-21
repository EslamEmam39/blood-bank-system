<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'content', 'sent_at', 'is_read',  'donation_request_id',
    ];


    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function donationRequest()
    {
        return $this->belongsToMany(DonationRequest::class);
    }

 
}
