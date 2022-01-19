<!DOCTYPE html>
<!-- Template by quackit.com -->
<html>
<head>
<body>
    <div class="counter ">
        <div class="row" style="text-align: center;">
            <h2><strong>Ohi and Mahi Departmantal store</strong></h2>
            <h2>Supplier Stock Report</h2>
  
        </div>

        <div class="row">
        <strong>Supplier Name:{{$alldata['0']['supplier']['name']}}</strong>
            <table border="1" width="100%">
                <thead>
                    <tr>
                      <th>SL</th>
                      <th>Category</th>
                      <th>Product Name</th>
                      <th>Quantity</th>
                      <th>Unit</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                     @foreach( $alldata as $key => $product)
                    <tr>
                        <td>{{$key++}}</td>
                        <td>{{$product['category']['name']}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product['unit']['name']}}</td>
                        @php
                           $count_product = App\Purchase::where('product_id',$product->id)->count();
                        @endphp
                    </tr>
                    @endforeach
                    </tfoot>
              </table>


        </div>

    </div>
				  

</body>
</html>