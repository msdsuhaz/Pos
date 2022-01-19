@extends('pos.master')

@section('main-contant')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage password</h1>
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
                 <h3>password Change
                 <a class="btn btn-success float-right"href="{{route('profile.view')}}"><i class="fa fa-plus-circle"></i>Profile</a>
                 </h3>
              </div>
              <div class="card-body">
              <form action="{{route('update.password')}}" method="POST" id="myfrom">
                    @csrf
                    
                    <div class="form-group">
                      <label for="currentpassword">Current Password:</label>
                      <input type="password" class="form-control" id="currentpassword" placeholder="Enter password" name="currentpassword">
                      @if ($errors->has('currentpassword'))
                         <span class="text-danger">{{ $errors->first('currentpassword') }}</span>
                      @endif
                    </div>
                    <div class="form-group">
                        <label for="newpassword">New Password:</label>
                        <input type="password" class="form-control" id="newpassword" placeholder="Enter password" name="newpassword">
                        @if ($errors->has('newpassword'))
                           <span class="text-danger">{{ $errors->first('newpassword') }}</span>
                        @endif
                      </div>
                    <div class="form-group">
                        <label for="password2" class="col-form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm password">
                    </div>
        
                    <button type="submit" class="btn btn-success">Submit</button>
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
          
         currentpassword: {
            required: true,
          },
          newpassword: {
            required: true,
          },
          password2: {
            required: true,
            equalTo :'#newpassword'
          }
        },
        messages: {

         newpassword: {
            required: "Please provide current password",
          },
          
          currentpassword: {
            required: "Please provide a password",
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