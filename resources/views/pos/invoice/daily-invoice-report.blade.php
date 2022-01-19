@extends('pos.master')

@section('main-contant')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Inovice</h1>
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
    @if ( Session::has('error'))
     <div class="alert alert-danger" align="center">
     <p>{{Session::get('error')}}</p>
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
                 <h3>Dayliy Invoice</h3>
              </div>
             
              <div class="card-body">
                <form method="GET"  action="{{route('daily-invoice-generate')}}" target="_blank">
                     <div class="form-row">
                       <div class="form-group col-md-2">
                        <label>Start Date:</label>
                        <input type="date" class="form-control  form-control-sm datepicker" placeholder="YYYY/DD/MM" name="start_date"  id="start_date"/>
                       </div>

                       <div class="form-group col-md-2">
                        <label>End Date:</label>
                        <input type="date" class="form-control  form-control-sm datepicker1" placeholder="YYYY/DD/MM" name="end_date"  id="end_date"/>
                       </div>
                       
                        <div class="form-group col-md-1 " style="padding-top:30px;">
                            <button type="submit" class="btn btn-success">Search</button>
                        </div>
                
                </form>
                <!-- /.card-body --> 
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

  

 
<script type="text/javascript">
    $('.datepicker').datepicker({  
       format: 'mm-dd-yyyy'
     });  
</script> 

<script type="text/javascript">
    $('.datepicker1').datepicker({  
       format: 'mm-dd-yyyy'
     });  
</script> 


  
@endsection