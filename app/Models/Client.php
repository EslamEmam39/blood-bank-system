<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

// هنا تم تعديل الوراثه من model to Authenticatable
class Client extends Authenticatable
{
    use HasFactory , HasApiTokens , HasRoles; 

       protected $guard_name = 'client';

   protected $fillable = [
        'name',
        'email',
        'birth_date',
        'city_id',
        'phone',
        'donation_last_date',
        'password',
        'blood_type_id',
        'is_active',
        'api_token',
        'pin_code',
        
    ];

    protected $hidden = [
        'password',
        'api_token',
        'pin_code',
    ];

public function favorites()
{
    return $this->belongsToMany(Article::class, 'favorites' ,'client_id' , 'article_id')->withTimestamps();
}

  
    public function bloodType()
    {
        return $this->belongsTo(Blood_type::class);
    }
       public function bloodTypes()
    {
    return $this->belongsToMany(Blood_type::class);
    }

    public function governorates()
    {
        return $this->belongsToMany(Governorate::class, 'client_gonvernorate');
    }

   
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function donationRequests()
    {
        return $this->hasMany(DonationRequest::class);
    }

    // علاقة مع Article عبر Pivot Table
    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function notifications()
    {
        // return $this->belongsToMany(Notification::class, 'client_notification');

            return $this->belongsToMany(Notification::class)->withPivot('is_read');

    }
  
  
}
