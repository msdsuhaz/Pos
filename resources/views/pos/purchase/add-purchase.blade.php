@extends('pos.master')

@section('main-contant')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Purchase</h1>
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
                 <h3>Add purchase
                 <a class="btn btn-success float-right"href="{{route('product.view')}}"><i class="fa fa-plus-circle"></i>purchase List</a>
                 </h3>
              </div>
             
              <div class="card-body">
                    <div class="form-row">
                       <div class="form-group col-md-4">
                        <label>Date:</label>
                        <input type="date" class="form-control datepicker" placeholder="YYYY/DD/MM" name="date"  id="date"/>
                       </div>
                       <div class="form-group col-md-4">
                        <label>Purchse No:</label>
                        <input type="text" class="form-control" id="purchases_no"  name="purchases_no" >
                       </div>
                       <div class="form-group col-md-4">
                        <label>Supplier Name:</label>
                         <select name="supplier_id" id="supplier_id"class="form-control select2">
                              <option value="">Select Supplier</option>
                              @foreach ($suppliers as $supplier)
                               <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                              @endforeach
                         </select>
                        </div>
                       <div class="form-group col-md-4">
                        <label > Category:</label>
                         <select name="category_id" id="category_id" class="form-control select2">
                              <option value="">Select Category</option>
                         </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name"> Product Name:</label>
                             <select name="product_id" id="product_id" class="form-control select2">
                                  <option value="">Select Product</option>
                             </select>
                        </div>
                        <div class="form-group col-md-2 " style="padding-top:30px;">
                            <i class="btn btn-success fa fa-plus-circle addeventmore">+ Add List</i>
                        </div>
                
                </div>
                <!-- /.card-body -->
              </div>

              <div class="card-body">
              <form action="{{route('purchase.store')}}" method="post">
                      @csrf
                      <table class="table-sm table-bordered" width="100%">
                        <thead>
                             <tr>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th width="7%">pcs/kg</th>
                                <th width="10%">Unit price</th>
                                <th>Description</th>
                                <th width="10%">Total price</th>
                                <th>Action</th>
                             </tr>
                        </thead>
                        <tbody id="addRow" class="addRow">
                            
                        </tbody>
                        <tbody>
                             <tr>
                               <td colspan="5"></td>
                               <td> 
                                <input type="text" name="estimated_amount" value="0"
                                id="estimated_amount" class="form-control-sm text-right estimated_amount"
                                readonly style="background-color: #D8FDBA">
                               </td>
                               <td></td>
                             </tr>
                        </tbody>
                     </table>
                    <br>
                    <div class="form-group">
                         <button type="submit" class="btn btn-primary" id="storeButton">Purchase Store</button>
                    </div>
                    </form>
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

  <script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
       <input type="hidden" name="date[]" value="@{{date}}">
       <input type="hidden" name="purchases_no[]" value="@{{purchases_no}}">
       <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
       <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
         @{{category_name}}
       </td>
       <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">
         @{{product_name}}
       </td>
       <td>
        <input type="number" min="1" class="form-control form-control-sm text-right buying_qty"
        name="buying_qty[]" value="1">
       </td>
       <td>
        <input type="number"  class="form-control form-control-sm text-right unit_price" name="unit_price[]" value=" ">
       </td>
       <td>
        <input type="text"  class="form-control form-control-sm " name="description[]" >
       </td>
       <td>
        <input   class="form-control form-control-sm buying_price " name="buying_price[]" value="0" readonly>
       </td>
       <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </tr>

  </script>

  <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click','.addeventmore',function(){
              var date = $('#date').val();
              var purchases_no =$('#purchases_no').val();
              var supplier_id =$('#supplier_id').val();
              var category_id =$('#category_id').val();
              var category_name =$('#category_id').find('option:selected').text();
              var product_id =$('#product_id').val();
              var product_name =$('#product_id').find('option:selected').text();


              if(date==''){
                $.notify("Date is required",{globalPosition: 'top right',className:'error'});
                return false;
              }
              if(purchases_no==''){
                $.notify("purchase No is required",{globalPosition: 'top right',className:'error'});
                return false;
              }
              if(supplier_id==''){
                $.notify("supplier is required",{globalPosition: 'top right',className:'error'});
                return false;
              }
              if(category_id==''){
                $.notify("category is required",{globalPosition: 'top right',className:'error'});
                return false;
              }
              if(product_id==''){
                $.notify("product is required",{globalPosition: 'top right',className:'error'});
                return false;
              }
              var source =$("#document-template").html();
              var template = Handlebars.compile(source);
              var data ={
                   date:date,
                   purchases_no:purchases_no,
                   supplier_id:supplier_id,
                   category_id:category_id,
                   category_name:category_name,
                   product_id:product_id,
                   product_name:product_name
              };
              var html = template(data);
              $("#addRow").append(html);
        });
            $(document).on("click",".removeeventmore",function(event){
                 $(this).closest(".delete_add_more_item").remove();
                 totalAmountPrice();
            });

            $(document).on('keyup click','.unit_price,.buying_qty',function(){
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.buying_qty").val();
                var total =unit_price*qty;
                $(this).closest("tr").find("input.buying_price").val(total);
                totalAmountPrice();
            })

            function totalAmountPrice(){
               var sum=0;
               $(".buying_price").each(function(){
                   var value = $(this).val();
                   if(!isNaN(value) && value.leagth != 0){
                      sum += parseFloat(value);
                   }
               });
               $('#estimated_amount').val(sum);
            }
           
      });
  </script>

   <script type="text/javascript">
      $(function(){
        $(document).on('change','#supplier_id',function(){
          var supplier_id = $(this).val();
          $.ajax({
            url:"{{route('get-category')}}",
            method:"GET",
            data:{supplier_id:supplier_id},
            success:function(data){
              var html ='<option value="">select Catagory</option>';
              $.each(data,function(key,v){
                html +='<option value="'+v.category_id+'">'+v.category.name+'</option>';
              });
              $('#category_id').html(html);
            }
          })
        });
  })

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
  })

</script>

    <script type="text/javascript">
    $('.datepicker').datepicker({  
       format: 'mm-dd-yyyy'
     });  
  </script> 
  
@endsection