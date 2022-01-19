@extends('pos.master')

@section('main-contant')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Approved Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Fixed Footer Layout</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    @if(session('message'))
    <div class="alert alert-success" role="alert" width="400px">
      {{Session::get('message')}}
    </div>
    @endif
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                 <h3>Invoice No #{{$invoice->invoice_no}}
                 <a class="btn btn-success float-right"href="{{route('invoice.approved.list')}}"><i class="fa fa-plus-circle"></i> Invoice approved list</a>
                 </h3>
              </div>
                <div class="card-body">
                     @php
                         $payment=App\payment::where('invoice_id',$invoice->id)->first();
                     @endphp
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td width="15%"><p><strong>Castomer info</strong></p></td>
                                <td width="25%"><p><strong>Name:</strong>{{$payment['customer']['name']}}</p></td>
                                <td width="25%"><p><strong>phone:</strong>{{$payment['customer']['phone_no']}}</p></td>
                                <td width="35%"><p><strong>Address:</strong>{{$payment['customer']['address']}}</p></td>
                            </tr>
                            <tr>
                                <td width="15%"></td>
                                <td width="85%" colspan="3"><strong>Description:</strong>{{$invoice->description}}</td>
                            </tr>
                        </tbody>

                    </table>
                    
                    <form method="post" action="{{route('invoice-approved-stock',$invoice->id)}}">
                      @csrf
                      
                      <table border="1" width="100%">
                        <thead>
                             <tr>
                                 <th>SL.</th>
                                 <th>Category</th>
                                 <th>Product Name</th>
                                 <th>Current stock</th>
                                 <th>Quantity</th>
                                 <th>Unit price</th>
                                 <th>Total</th>
                             </tr>
                        </thead>
                        <tbody>
                            @php
                                $total_sum =0;
                            @endphp
                            @foreach ($invoice['invoiceDetails'] as $key=>$details)
                                    <tr>
                                        <input type="hidden" name="customer_id[]" value="{{$details->customer_id}}">
                                        <input type="hidden" name="product_id[]" value="{{$details->product_id}}">
                                        <input type="hidden" name="selling_qty[{{$details->id}}]" value="{{$details->selling_qty}}">
                                        <td>{{$key++}}</td>
                                        <td>{{$details['category']['name']}}</td>
                                        <td>{{$details['product']['name']}}</td>
                                        <td>{{$details['product']['quantity']}}</td>
                                        <td>{{$details->selling_qty}}</td>
                                        <td>{{$details->unit_price}}</td>
                                        <td>{{$details->selling_price}}</td>
                                    </tr>
                                    @php
                                       $total_sum +=$details->selling_price;
                                    @endphp
                            @endforeach

                            <tr >
                               <td colspan="6" class="text-right"><strong>Sum Total</strong></td>
                               <td>{{ $total_sum}}</td>
                            </tr>
                            <tr >
                              <td colspan="6" class="text-right">Discount</td>
                              <td>{{$payment->discount_amount}}</td>
                           </tr>
                           <tr >
                            <td colspan="6" class="text-right">Paid Amount</td>
                            <td>{{$payment->paid_amount}}</td>
                           </tr>
                           <tr >
                            <td colspan="6" class="text-right">Due Amount</td>
                            <td>{{$payment->due_amount}}</td>
                           </tr>
                           <tr >
                            <td colspan="6" class="text-right"><strong>Grand Total</strong></td>
                            <td>{{$payment->total_amount}}</td>
                           </tr>
                              
                          </tbody>
                      </table>
                      <br>
                      <button type="submit" class="btn btn-success">Invoice Approved</button>
                    </form>
                  
               
                </div>
                <!-- /.card-body -->
              </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
            
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection