<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Indonesia;
use Yajra\DataTables\Html\Builder;
use DataTables;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function rules() {
        return [
            'name' => 'required',
            'city_id' => 'required'
        ];
    }

    public function index(Request $request, Builder $builder)
    {
    	$data = Customer::with(['city']);
        $cities = Indonesia::allCities();

    	if (request()->ajax()) {
	        return DataTables::eloquent($data)
                ->editColumn('city', function($customer) {
                    return $customer->city->name;
                })
		        ->addColumn('action',function($data){
	                return View('admin.inc._action',['id'=>$data->id,'detail'=>false]);
	            })->toJson();
	    }

	    $html = $builder->columns([
            ['data'=>'name','name'=>'name','title'=>'Customer Name'],
            ['data'=>'city','name'=>'city.name','title'=>'City'],
            ['data'=>'action','name'=>'action','title'=>'#', 'searchable'=> false, 'orderable' => false],
        ]);

	    return view('admin.customers.index', compact('html','cities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        $customer = Customer::create($request->all());
        return response()->json($customer,201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());
        return response()->json($customer,200);
    }

    public function edit($id)
    {
        $data = Customer::findOrFail($id);
        return response()->json($data,200);
    }

    public function destroy($id)
    {
        $data = Customer::findOrFail($id)->delete();
        return response()->json(null,204);
    }

    

}
