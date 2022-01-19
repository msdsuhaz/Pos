@extends('pos.master')

@section('main-contant')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Invoice Approved</h1>
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
                 {{-- <h3>Invoice list
                 <a class="btn btn-success float-right"href="{{route('invoice.add')}}"><i class="fa fa-plus-circle"></i>Add Invoice</a>
                 </h3> --}}
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-response">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Customer Name</th>
                      <th>Invoice No</th>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Amount</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($alldata as $key=>$invoice)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                              {{$invoice['payment']['customer']['name']}}
                              ( {{$invoice['payment']['customer']['phone_no']}}
                              - {{$invoice['payment']['customer']['address']}})
                            </td>
                            <td>Invoice No #{{$invoice->invoice_no}}</td>
                            <td>{{date('d-m-Y',strtotime($invoice->data))}}</td>
                            <td>{{$invoice->description}}</td>
                            <td>{{$invoice['payment']['total_amount']}}</td>
                            <td>
                              @if($invoice->status=='0')
                              <span style="background:#FC4236; padding:5px;">Panding</span>
                              @elseif($invoice->status=='1')
                              <span style="background:#5EAB00; padding:5px;">Approved</span>
                              @endif
                            </td>
                             <td> 
                                @if($invoice->status=='0')
                                <a title="Approved" class="btn btn-sm btn-success" href="{{route('invoice.approved',$invoice->id)}}"><i class="fa fa-check-circle"></i></a>
                                <a title="Delete" id ="delete"class="btn btn-sm btn-danger" href="{{route('invoice.delete',$invoice->id)}}"><i class="fa fa-trash"></i></a>
                                @endif
                               
                              
                            </td>
                                
                            
                        </tr>
                     @endforeach
                    </tbody>
                    </tfoot>
                  </table>
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