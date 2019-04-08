<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Indonesia;

class ApiController extends Controller
{
    public function customers()
    {
    	return response()->json(Customer::all(),200);
    }

    public function cityCustomer($id)
    {
    	$customer = Customer::with('city')->findOrFail($id);
    	return response()->json($customer, 200);
    }
}
