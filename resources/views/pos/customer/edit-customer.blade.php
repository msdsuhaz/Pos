@extends('pos.master')

@section('main-contant')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage customer</h1>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                 <h3>Add customer
                 <a class="btn btn-success float-right"href="{{route('customer.view')}}"><i class="fa fa-plus-circle"></i>customer List</a>
                 </h3>
              </div>
             
              <div class="card-body">
              <form action="{{route('customer.update',$editdata->id)}}" method="POST" id="myfrom">
                    @csrf
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="name">customer Name:</label>
                        <input type="text" class="form-control" id="name" value="{{$editdata->name}}"  placeholder="Enter customer Name" name="name" required>
                        @if ($errors->has('name'))
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                      </div>
                    <div class="form-group col-md-4">
                      <label for="email">Mobile:</label>
                      <input type="text" class="form-control" id="phone_no" value="{{$editdata->phone_no}}" placeholder="Enter phone" name="phone_no" required>
                        @if ($errors->has('phone_no'))
                          <span class="text-danger">{{ $errors->first('phone_no') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" value="{{$editdata->email}}" placeholder="Enter email" name="email" required>
                          @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                          @endif
                      </div>
                      <div class="form-group col-md-6">
                        <label for="address">Address:</label>
                        <input type="address" class="form-control"  value="{{$editdata->address}}" id="address" placeholder="Enter address" name="address" required>
                          @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                          @endif
                      </div>
                    </div>
        
                    <button type="submit" class="btn btn-success">Update</button>
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

  <script type="text/javascript">
    $(document).ready(function () {
      $('#myfrom').validate({
        rules: {
         usertype: {
            required: true,
          },
          name: {
            required: true,
          },
          email: {
            required: true,
            email: true,
          },
          password: {
            required: true,
            minlength: 6
          },
          password2: {
            required: true,
            equalTo :'#password'
          }
        },
        messages: {
          usertype: {
            required: "Please enter user role"
          },
          name: {
            required: "Please enter user name"
          },
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 characters long"
          },

          password2: {
            required: "Please provide confirm password",
            equalTo: "confirm password does not match"
          },
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
    </script>
  <!-- /.content-wrapper -->
@endsection