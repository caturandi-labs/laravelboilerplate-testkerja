<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Indonesia;
use Yajra\DataTables\Html\Builder;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function rules() {
        return [
            'code' => 'required',
            'customer_id' => 'required',
            'total' => 'required'
        ];
    }

    public function index(Request $request, Builder $builder)
    {
    	$data = Order::with(['customer','details']);
    	if (request()->ajax()) {
	        return DataTables::eloquent($data)
                ->editColumn('customer', function($order) {
                    return $order->customer->name;
                })
                ->editColumn('created_date', function($order) {
                    return tanggalIndonesia($order->created_at);
                })->toJson();
	    }

	    $html = $builder->columns([
	    	['data'=>'code','name'=>'code','title'=>'Inv. Number'],
	    	['data'=>'created_date','name'=>'created_date','title'=>'Date'],
            ['data'=>'customer','name'=>'customer.name','title'=>'Customer Name'],
            
        ]);

	    return view('admin.orders.index', compact('html'));
    }

    public function create()
    {
    	$customers = Customer::all();
    	$date = tanggalIndonesia(now(),true, false);
        return view('admin.orders.create', compact('customers','date'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        \DB::beginTransaction();

        try{
            $order = new Order;
            $order->customer_id = $request['customer_id'];
            $order->code = $request['code'];
            $order->total = $request['total'];
            $order->save();
            $carts = $request['carts'];
            $cartInstance = [];
            foreach ($carts as $item) {
                $cartInstance[] = new OrderDetail($item);
            }
            $order->details()->saveMany($cartInstance);
            \DB::commit();
        }catch(Exception $e){
            \DB::rollBack();
        }
        

        return response()->json($order,201);
    }

}
