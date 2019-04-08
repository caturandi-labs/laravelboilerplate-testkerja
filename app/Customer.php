<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\City;

class Customer extends Model
{
    protected $fillable = ['name', 'city_id'];

    public function city()
    {
    	return $this->belongsTo(City::class);
    }

    public function orders()
    {
    	return $this->hasMany(Order::class);
    }
}
