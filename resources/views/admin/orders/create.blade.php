@extends('layouts.admin')

@section('title','New Transaction')

@section('content')
	
	<div id="app">
    <table-item></table-item>
  </div>


@endsection

@push('scripts')

  <script>
    const BASE_URL = `{{ env('APP_URL') }}`;

    Vue.component('table-item', {
      data:function () {
        return {
          carts: [
            {item: '', price: 0, qty: 1}
          ],
          total:0,
          code: this.generateInvoice(),
          customers: [],
          customer: '',
          city:'',
          url: `${BASE_URL}orders`
        }
      },
      template: `
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                      <h4 class="ml-4">New Invoice</h4>
                    </div>
                    <div class="card-body">
                    <form method="post" @submit.prevent="handleSubmit">
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="date">Date</label>
                          <input type="text" value="{{ $date }}" class="form-control" id="date" readonly>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="code">Invoice Number</label>
                          <input readonly type="text" class="form-control" v-model="code">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="customer">Customer</label>
                          <select v-model="customer" v-on:change="loadCity" class="form-control" name="customer_id" id="customer_id">
                            <option value="" selected disabled>- Select Customer -</option>
                            <option v-for="customer in customers" :value="customer.id" v-html="customer.name"></option>
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="city">City</label>
                          <input type="text" v-model="city" class="form-control" readonly id="city">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <button @click="addItem" class="btn btn-info"><i class="fas fa-plus"></i> Add Item</button>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Item</th>
                              <th>Qty</th>
                              <th>Price</th>
                              <th>Sub Total</th>
                              <th>#</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="(cart, key) in carts">
                              <td>
                                <input v-model="cart.item" type="text" id="item" autofocus name="item" required class="form-control" placeholder="Item name">
                              </td>
                              <td>
                                <input v-model="cart.qty" type="number" id="qty" name="qty" class="form-control" required placeholder="Qty">
                              </td>
                              <td>
                                <input v-model="cart.price" type="number" id="price"  name="price" class="form-control" required placeholder="Item Price">
                              </td>
                              <td>
                                <input type="number" class="form-control" readonly v-model="cart.qty*cart.price" />
                              </td>
                              <td>
                                <button class="btn btn-danger" @click="removeRow(key)"><i class="fas fa-trash"></i></button>
                              </td>
                            </tr>
                          </tbody>
                        
                        </table>

                        <div class="form-group">
                          <button class="btn btn-success">Save Transaction</button>
                          <a :href="url" class="btn btn-danger">Cancel</a>
                        </div>
                        <div class="alert alert-primary">
                          <h1 v-html="countTotal"></h1>
                        </div>
                      </div>    
                    </form>     
                    </div>
                  </div>
              </div>            
            </div>
          </div>
        </section>
      `,
      mounted() {
        this.loadCustomers();
      },
      computed: {
        countTotal: function() {
          this.total = 0;
          this.carts.forEach((cart)=>{
            this.total += (cart.qty*cart.price);
          });

          return `Total Rp. ${this.total}`;
        }
      },
      methods: {
        addItem: function(){
          this.carts.push({item: '', price: 0, qty: 1});
        },
        removeRow: function(key){
          this.carts.splice(key,1);
        },
        generateInvoice: function() {
          var date = new Date().getTime();

          var text = "";
          var possible = "0123456789";

          for (var i = 0; i < 4; i++)
            text += possible.charAt(Math.floor(Math.random() * possible.length));

          let output = 'INV-' +text+ date;
          
          return output;
        },
        loadCustomers() {
          axios.get(`${BASE_URL}api/customers`)
            .then(res => this.customers = res.data)
            .then(()=> console.log(this.customers))
            .catch(err => console.log(err));
        },
        loadCity() {
          axios.get(`${BASE_URL}api/city_customer/${this.customer}`)
            .then(res => this.city = res.data.city.name)
            .catch(err => console.log(err));
        },
        handleSubmit() {
          axios.post(`${BASE_URL}orders`, {
            'code': this.code,
            'customer_id': this.customer,
            'carts': this.carts,
            'total': this.total
          }, {
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          }).then(res=> console.log(res))
            .then(()=>this.resetForm())
            .catch(err=> console.log(err));
        },

        resetForm() {
          this.carts =  [
            {item: '', price: 0, qty: 1}
          ];
          this.total = 0;
          this.code = this.generateInvoice();
          this.customer =  '';
          this.city = '';
        }

      },
    });

    new Vue({
      el: "#app"
    });

  </script>
@endpush