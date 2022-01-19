@extends('pos.master')

@section('main-contant')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
               
              </div>
              <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                          <h1><strong>Supplier and Produdct Wise Report</strong></h1>
                          <br>
                        </div>
                        <div class="col-sm-12 text-center">
                           <strong>Supplier wise Report</strong>
                           <input type="radio" class="search_value" name="supplier_product_wise" value="supplier_wise"
                           />&nbsp;&nbsp;
                           <strong>Product wise Report</strong>
                           <input type="radio" class="search_value" name="supplier_product_wise" value="product_wise"
                           />&nbsp;&nbsp;
                        </div>
                    </div>

                     <div class="show_supplier" style="display: none;">
                     <form method="GET" action="{{route('stock.report.supplier.report.pdf')}}" id="supplierwiseid"
                        target="_blank" >
                             <div class="form-row">
                                 <div class="col-sm-8">
                                    <label for="name">Supplier Name:</label>
                                   <select name="supplier_id" class="form-control select2">
                                            <option value="">Select Supplier</option>
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                            @endforeach
                                   </select>
                                 </div>
                                 <div class="col-sm-4" style="padding-top:32px;">
                                      <button type="submit" class="btn btn-success">Search</button>
                                 </div>

                             </div>
                        </form>

                    </div>

                    <div class="show_product" style="display: none;" >
                          <form method="GET" action="{{route('product-wise-stock-report-pdf')}}" starget="_blank" >
                                <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>Category Name:</label>
                                         <select name="category_id" id="category_id"class="form-control select2">
                                              <option value="">Select Supplier</option>
                                              @foreach ($categoryes as $categorye)
                                               <option value="{{$categorye->id}}">{{$categorye->name}}</option>
                                              @endforeach
                                         </select>
                                        </div>
                                        <div class="form-group col-md-5">
                                            <label for="name"> Product Name:</label>
                                             <select name="product_id" id="product_id" class="form-control select2">
                                                  <option value="">Select Product</option>
                                             </select>
                                        </div>
                                    <div class="col-sm-2" style="padding-top:25px;">
                                         <button type="submit" class="btn btn-success">Search</button>
                                    </div>
   
                                </div>
                           </form>
   
                       </div>
              
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
  <script type="text/javascript">
    $(document).on('change','.search_value',function(){
        var product_name = $(this).val();
        if(product_name == 'supplier_wise'){
            $('.show_supplier').show();
        }else{
            $('.show_supplier').hide();
        }
        
    });
  </script>

<script type="text/javascript">
    $(document).on('change','.search_value',function(){
        var supplier_name = $(this).val();
        if(supplier_name == 'product_wise'){
            $('.show_product').show();
        }else{
            $('.show_product').hide();
        }
        
    });
  </script>

<script type="text/javascript">
    $(document).ready(function () {
      $('#supplierwiseid').validate({
        rules: {
            supplier_id: {
                required: true,
          },
        },
        messages: {
        
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

    
<script type="text/javascript">
    $(function(){
      $(document).on('change','#category_id',function(){
         var category_id = $(this).val();
         $.ajax({
           url:"{{route('get-product')}}",
           method:"GET",
           data:{category_id:category_id},
           success:function(data){
             var html ='<option value="">select product</option>';
             $.each(data,function(key,v){
               html +='<option value="'+v.id+'">'+v.name+'</option>';
             });
             $('#product_id').html(html);
           }
         })
      });
    });
  
  </script>
  
@endsection


