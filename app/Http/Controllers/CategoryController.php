<?php

namespace App\Http\Controllers;
use App\Category;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Html\Builder;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function rules() {
        return [
            'name' => 'required|unique:categories'
        ];
    }

    public function index(Request $request, Builder $builder)
    {
    	$data = Category::query();
    	if (request()->ajax()) {
	        return datatables($data)
		        ->addColumn('action',function($data){
	                return View('admin.inc._action',['id'=>$data->id,'detail'=>false]);
	            })->toJson();
	    }

	    $html = $builder->columns([
            ['data'=>'name','name'=>'name','title'=>'Category Name'],
            ['data'=>'action','name'=>'action','title'=>'#', 'searchable'=> false, 'orderable' => false],
        ]);

	    return view('admin.categories.index', compact('html'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        
        $category = Category::create($request->all());
        return response()->json($category,201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        }
        
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category,200);
    }

    public function edit($id)
    {
        $data = Category::findOrFail($id);
        return response()->json($data,200);
    }

    public function destroy($id)
    {
        $data = Category::findOrFail($id)->delete();
        return response()->json(null,204);
    }
}
