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
                 <h3>Add Invoice
                 <a class="btn btn-success float-right"href="{{route('invoice.view')}}"><i class="fa fa-plus-circle"></i>Invoice List</a>
                 </h3>
              </div>
             
              <div class="card-body">
                    <div class="form-row">
                      <div class="form-group col-md-1">
                        <label>Invoice No:</label>
                        <input type="text" class="form-control form-control-sm" value="{{$invoice_no}}" name="invoice_no"  id="invoice_no" readonly style="background-color: #D8FDBA"/>
                       </div>
                       <div class="form-group col-md-2">
                        <label>Date:</label>
                        <input type="date" class="form-control  form-control-sm datepicker" placeholder="YYYY/DD/MM" name="date"  id="date"/>
                       </div>
                       <div class="form-group col-md-3">
                        <label>Category Name:</label>
                         <select name="category_id" id="category_id"class="form-control select2">
                              <option value="">Select Supplier</option>
                              @foreach ($categoryes as $categorye)
                               <option value="{{$categorye->id}}">{{$categorye->name}}</option>
                              @endforeach
                         </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="name"> Product Name:</label>
                             <select name="product_id" id="product_id" class="form-control select2">
                                  <option value="">Select Product</option>
                             </select>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="name"> Stock(pcs/kg):</label>
                        <input type="text" name="current_stock_qty" id="current_stock_qty"  class="form-control form-control-sm"  style="background-color: #D8FDBA"/>
                        </div>
                        <div class="form-group col-md-1 " style="padding-top:30px;">
                            <i class="btn btn-success fa fa-plus-circle addeventmore">+ Add</i>
                        </div>
                
                </div>
                <!-- /.card-body -->
              </div>

              <div class="card-body">
              <form action="{{route('invoice.store')}}" method="post">
                      @csrf
                      <table class="table-sm table-bordered" width="100%">
                        <thead>
                             <tr>
                                <th>Category</th>
                                <th>Product Name</th>
                                <th width="7%">pcs/kg</th>
                                <th width="10%">Unit price</th>
                                <th width="10%">Total price</th>
                                <th>Action</th>
                             </tr>
                        </thead>
                        <tbody id="addRow" class="addRow">
                            
                        </tbody>
                        <tbody>
                             <tr>
                                 <td class="text-right" colspan="4"><strong>Discount</strong></td>
                                 <td>
                                  <input type="text" name="discount_amount"
                                  id="discount_amount" class="form-control form-control-sm text-right discount_amount">
                                 </td>
                             </tr>
                             <tr>
                               <td colspan="4"></td>
                               <td> 
                                <input type="text" name="estimated_amount" value="0"
                                id="estimated_amount" class="form-control form-control-sm text-right estimated_amount"
                                readonly style="background-color: #D8FDBA">
                               </td>
                               <td></td>
                             </tr>
                        </tbody>
                     </table>
                    <br>
                    <div class="form-row">
                         <div class="form-group col-md-12">
                           <textarea name="description" id="description" class="form-control"
                           placeholder="Write you Description"></textarea>
                         </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                           <label>Paid Status</label>
                           <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                              <option value="0">Select status</option>
                              <option value="full_paid">Full Paid</option>
                              <option value="full_due">Full Due</option>
                              <option value="partical_paid">Partical paid</option>
                           </select>
                              <input type="text" name="paid_amount" class="form-control form-control-sm paid_amount"
                               placeholder="Enter paid Amount" style="display:none;"/>
                          
                        </div>
                        <div class="form-group col-md-9">
                          <label>Castomer Name:</label>
                           <select name="customer_id" id="customer_id"class="form-control select2">
                                <option value="">Select Caustomer</option>
                                @foreach ($castomers as $castomer)
                                 <option value="{{$castomer->id}}">{{$castomer->name}} ({{$castomer->phone_no}}-{{$castomer->address}})</option>
                                @endforeach
                                <option value="0">New Castomer</option>
                           </select>
                        </div>
                      </div>
                     <div class="form-row new_castomer " style="display:none;">
                         <div class="form-group col-md-4">
                             <input type="text" name="name" id="name" class="form-control form-control-sm"
                             placeholder="write your name"/>
                         </div>
                         <div class="form-group col-md-4">
                              <input type="text" name="phone_no" id="phone_no" class="form-control form-control-sm"
                              placeholder="write phone name"/>
                         </div>
                         <div class="form-group col-md-4">
                            <input type="text" name="address" id="address" class="form-control form-control-sm"
                            placeholder="write your address"/>
                         </div>
                     </div>
                    <div class="form-group">
                         <button type="submit" class="btn btn-primary" id="storeButton">Invoice Store</button>
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
       <input type="hidden" name="date" value="@{{date}}">
       <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
       <td>
        <input type="hidden" name="category_id[]" value="@{{category_id}}">
         @{{category_name}}
       </td>
       <td>
        <input type="hidden" name="product_id[]" value="@{{product_id}}">
         @{{product_name}}
       </td>
       <td>
        <input type="number" min='1' class="form-control form-control-sm text-right selling_qty	"
        name="selling_qty	[]" value="1">
       </td>
       <td>
        <input type="number"  class="form-control form-control-sm text-right unit_price" name="unit_price[]" value=" ">
       </td>
       <td>
        <input  type="number"  class="form-control form-control-sm selling_price " name="selling_price[]" value="0" readonly>
       </td>
       <td><i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i></td>
    </tr>

  </script>

  <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('click','.addeventmore',function(){
              var date = $('#date').val();
              var invoice_no =$('#invoice_no').val();
              var category_id =$('#category_id').val();
              var category_name =$('#category_id').find('option:selected').text();
              var product_id =$('#product_id').val();
              var product_name =$('#product_id').find('option:selected').text();


              if(date==''){
                $.notify("Date is required",{globalPosition: 'top right',className:'error'});
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
                   invoice_no:invoice_no,
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

            $(document).on('keyup click','.unit_price,.selling_qty',function(){
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.selling_qty").val();
                var total =unit_price*qty;
                $(this).closest("tr").find("input.selling_price").val(total);
                $('#discount_amount').trigger('keyup');
            });

            $(document).on('keyup','#discount_amount',function(){
              totalAmountPrice();
            });

            function totalAmountPrice(){
               var sum=0;
               $(".selling_price").each(function(){
                   var value = $(this).val();
                   if(!isNaN(value) && value.length != 0){
                      sum += parseFloat(value);  
                   }
               });
               var discount_amount =parseFloat($('#discount_amount').val());
               if(!isNaN(discount_amount) && discount_amount.length != 0){
                  sum -=parseFloat(discount_amount);
               }
               $('#estimated_amount').val(sum);
            }
           
      });
  </script>

<script type="text/javascript">
   $(document).on('change','#paid_status',function(){
       var paid_status = $(this).val();
       if(paid_status == 'partical_paid'){
           $('.paid_amount').show();
       }else{
           $('.paid_amount').hide();
       }
   });
</script>

<script type="text/javascript">
  $(document).on('change','#customer_id',function(){
      var customer_name = $(this).val();
      if(customer_name == '0'){
          $('.new_castomer').show();
      }else{
          $('.new_castomer').hide();
      }
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

<script type="text/javascript">
  $(function(){
    $(document).on('change','#product_id',function(){
         var product_id = $(this).val();
         $.ajax([
             url:"{{route('get-product-stock')}}",
             method:"GET",
             data:{product_id:product_id},
             success:function(data){
               $('#current_stock_qty').val(data);
             }

         ]);
    });
  });
   
</script>

<script type="text/javascript">
    $('.datepicker').datepicker({  
       format: 'mm-dd-yyyy'
     });  
</script> 

<script>


  @if(Session::has('success'))
     $('.top-right').notify({
        message: { text: "{{ Session::get('success') }}" }
      }).show();
     @php
       Session::forget('success');
     @endphp
  @endif


  @if(Session::has('info'))
      $('.top-right').notify({
        message: { text: "{{ Session::get('info') }}" },
        type:'info'
      }).show();
      @php
        Session::forget('info');
      @endphp
  @endif


  @if(Session::has('warning'))
  		$('.top-right').notify({
        message: { text: "{{ Session::get('warning') }}" },
        type:'warning'
      }).show();
      @php
        Session::forget('warning');
      @endphp
  @endif


  @if(Session::has('error'))
  		$('.top-right').notify({
        message: { text: "{{ Session::get('error') }}" },
        type:'danger'
      }).show();
      @php
        Session::forget('error');
      @endphp
  @endif


</script>
  
@endsection