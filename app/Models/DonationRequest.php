<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'patient_name',
        'patient_age',
        'blood_type_id',
        'bags_num',
        'hospital_name',
        'hospital_address',
        'city_id',
        'phone',
        'notes',
        'latitude',
        'longitude',
    ];

     public function bloodType()
    {
        return $this->belongsTo(Blood_type::class);
    }

     public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }


    public function scopeFilter($query, $filters)
{
    if (!empty($filters['bloodTypy'])) {
        $query->where('blood_type_id', $filters['bloodTypy']);
    }

    if (!empty($filters['city'])) {
        $query->where('city_id', $filters['city']);
    }

    return $query;
}

 }
