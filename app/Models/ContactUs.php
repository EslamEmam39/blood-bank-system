<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'message'  , 'client_id'
    ];

    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
