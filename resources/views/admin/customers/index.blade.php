@extends('layouts.admin')

@section('title','Customers')

@section('content')
	
	<section class="section">

    <div class="section-body">
      <div class="row">
	      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
	        <div class="card">
              <div class="card-header">
                <button id="addBtn" type="button" class="btn btn-lg btn-primary">Add Customer</button>
                <h4 class="ml-4">Customer</h4>
                
              </div>
              <div class="card-body">
                {!! $html->table(['class' => 'table table-striped'], true) !!}
              </div>
            </div>
	      </div>            
	    </div>
    </div>
  </section>


  @include('admin.customers.form', ['cities' => $cities])
	

@endsection

@push('scripts')
  {!! $html->scripts() !!}


  <script>
    let saveMethod="";

    $(document).ready(()=>{
      $('#addBtn').click(()=>{
        addForm();
      });

      $('#formModal form').on('submit', function(e){
        if(!e.isDefaultPrevented()){
          let form = $('#formModal form');
          form.find('.invalid-feedback').detach();
          form.find(`.form-control`).removeClass('is-invalid');
            const id = $('#id').val();
            if(saveMethod == "add") url = "{{ route('customers.store') }}";
            else url = "customers/"+id;

            let method = $('input[name=_method]').val();
            axios(url, {
                method: method,
                url: url,
                data: {
                  "name": $('#name').val(),
                  'city_id': $('#city_id').val()
                }
            })
            .then(function (response) {
              if (response.status == 201 || response.status == 200) {
                  $('#formModal').modal('hide');
                  toastr.success('Data Successfuly Added', 'Information', {timeOut: 4000});
                  $("#dataTableBuilder").DataTable().ajax.reload();
              }
              
            })
            .catch(function (error) {
              console.log(error);
              if(error.response.status == 400){
                let errors = error.response.data;
                $.each(errors, (key,val) => {
                  $(`#${key}`).addClass('is-invalid');
                  $(`#${key}`).after(`<div class="d-inline-block invalid-feedback" role="alert">${val.join(", ")}</div>`);
                });
              }
              
            });
        }
    });
    });

    
    {{-- Add data --}}
    function addForm(){
       saveMethod = "add";
       $('.modal-title').text('Add Customer');
       $('input[name=_method]').val('POST');
       $('#formModal').modal('show');
       $('#formModal form')[0].reset();
    }

    function edit(id){
        saveMethod = "edit";
        $('.modal-title').text('Edit Customer');
        $('input[name=_method]').val('PATCH');
        $('#formModal form')[0].reset();
        axios.get(`customers/${id}/edit`)
          .then(function (response) {
            if (response.status == 200) {
              let {id, name, city_id} = response.data;
              $('#formModal').modal('show');
              $('#id').val(id);
              $('#name').val(name);
              $('#city_id').val(city_id);
            }
          });
    }

    {{-- Delete Data --}}
    function destroy(id) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
          axios.post(`customers/${id}`, 
          {
              '_method' : 'DELETE', '_token' : $('meta[name=csrf-token]').attr('content')
          })
          .then(function (response) {
              console.log(response);
              if (response.status == 204) {
                  toastr.success('Data Succesfully Deleted', 'Information', {timeOut: 4000});
                  $("#dataTableBuilder").DataTable().ajax.reload();
              }
          })
          .catch(function (error) {
              
          });
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      });
    }
  </script>
@endpush