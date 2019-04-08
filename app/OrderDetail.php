<?php

namespace App;

use App\Order;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
	protected $fillable = ['order_id','item','qty','price'];

    public function order()
    {
    	return $this->belongsTo(Order::class, 'order_id');
    }
}
