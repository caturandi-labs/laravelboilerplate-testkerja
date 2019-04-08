@extends('layouts.admin')

@section('title','Orders')

@section('content')
	
	<section class="section">

    <div class="section-body">
      <div class="row">
	      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
	        <div class="card">
              <div class="card-header">
                <a href="{{ route('orders.create') }}" class="btn btn-lg btn-primary">New Transaction</a>
                <h4 class="ml-4">Orders</h4>
                
              </div>
              <div class="card-body">
                {!! $html->table(['class' => 'table table-striped'], true) !!}
              </div>
            </div>
	      </div>            
	    </div>
    </div>
  </section>


  {{-- @include('admin.categories.form') --}}
	

@endsection

@push('scripts')
  {!! $html->scripts() !!}
@endpush