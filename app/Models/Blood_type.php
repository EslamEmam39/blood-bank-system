<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blood_type extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

        // many-to-many with clients
        public function clients()
        {
            return $this->belongsToMany(Client::class);
        }
    
        // one-to-many with donation_requests
        public function donationRequests()
        {
            return $this->hasMany(DonationRequest::class);
        }
}
