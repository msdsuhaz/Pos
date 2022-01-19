@extends('pos.master')

@section('main-contant')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Profile</h1>
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
                 <h3>Edit Profile
                 <a class="btn btn-success float-right"href="{{route('profile.view')}}"><i class="fa fa-plus-circle"></i>Profile</a>
                 </h3>
              </div>
              <div class="card-body">
              <form action="{{route('profile.update')}}" method="POST" id="myfrom" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group col-md-4">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" value="{{$editData->name}}" placeholder="Enter user name" name="name" required>
                        @if ($errors->has('name'))
                          <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                      </div>
                      <div class="form-group col-md-4">
                      <label for="email">Email:</label>
                      <input type="email" class="form-control" id="email" value="{{$editData->email}}" placeholder="Enter email" name="email" required>
                        @if ($errors->has('email'))
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group col-md-4">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" value="{{$editData->phone}}" placeholder="Enter Phone" name="Phone" required>
                          @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                          @endif
                      </div>
                      <div class="form-group">
                        <label for="phone">Address:</label></br>
                        <textarea type="text" id="address" name="address" rows="4" cols="50">
                          {{$editData->address}}
                        </textarea>
                          @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                          @endif
                      </div>
                      <div class="form-group">
                        <label for="phone">Image:</label>
                        <input type="file" class="form-control" id="image"   name="image" required>
                      </div>
                      <div class="form-group">
                      <img  id="showImage" src="{{(!empty($editData->image))?asset('/upload/user_image/'.$editData->image):asset('/upload/no_image.png')}}">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="gender">Gender:</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="" >Select Gender</option>
                            <option value="male" {{($editData->gender=="male")?"selected":" "}}>Male</option>
                            <option value="female" {{($editData->gender=="female")?"selected":" "}}>Female</option>
                        </select>
                        @if ($errors->has('gender'))
                          <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                      </div>
                    <button type="submit" class="btn btn-success">update</button>
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