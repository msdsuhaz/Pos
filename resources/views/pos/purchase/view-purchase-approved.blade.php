@extends('pos.master')

@section('main-contant')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Purchse</h1>
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
                 <h3>Panding purchase list</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover table-response">
                    <thead>
                    <tr>
                      <th>SL</th>
                      <th>Product No</th>
                      <th>Date</th>
                      <th>Supplier Name</th>
                      <th>Category</th>
                      <th>Product Name</th>
                      <th>Description</th>
                      <th>Quantity</th>
                      <th>Unit price</th>
                      <th>buying Price</th>
                      <th>status</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                     @foreach( $alldata as $key => $purchase)
                    <tr>
                        <td>{{$key++}}</td>
                        <td>{{$purchase->purchases_no}}</td>
                        <td>{{date('d-m-y',strtotime($purchase->date))}}</td>
                        <td>{{$purchase['supplier']['name']}}</td>
                        <td>{{$purchase['category']['name']}}</td>
                        <td>{{$purchase['product']['name']}}</td>
                        <td>{{$purchase->description}}</td>
                        <td>
                          {{$purchase->buying_qty}}
                          {{$purchase['product']['unit']['name']}}
                        </td>
                        <td>{{$purchase->unit_price}}</td>
                        <td>{{$purchase->buying_price}}</td>
                        <td>
                          @if($purchase->status=='0')
                          <span style="background:#FC4236; padding:5px;">Panding</span>
                          @elseif($purchase->status=='1')
                          <span style="background:#5EAB00; padding:5px;">Approved</span>
                          @endif
                        </td>
  
                        <td>
                            @if($purchase->status=='0')
                            <a title="Approved" id ="Approved"class="btn btn-sm btn-success" href="{{route('purchase.approved',$purchase->id)}}"><i class="fa fa-check-circle"></i></a>
                            
                            @endif
                            @if($purchase->status=='1')
                            <a title="Unapproved" id ="Unapproved"class="btn btn-sm btn-success" href="{{route('purchase.unapproved',$purchase->id)}}"><i class="fa fa-arrowup"></i></a>
                            
                            @endif
                        </td>
                    </tr>
                    @endforeach
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