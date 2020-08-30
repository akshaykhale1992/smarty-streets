<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'address', 'city', 'state', 'zipcode',
        'property_type', 'longitude', 'latitude', 'sa_country',
        'ga_country',
    ];

    public function addAddress($addressData)
    {
        $this->create($addressData);
    }
}
