<?php

namespace App;

use App\Customer;
use App\OrderDetail;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $fillable = ['code', 'customer_id', 'total'];

	public function customer()
	{
		return $this->belongsTo(Customer::class);
	}

    public function details()
    {
    	return $this->hasMany(OrderDetail::class);
    }
}
