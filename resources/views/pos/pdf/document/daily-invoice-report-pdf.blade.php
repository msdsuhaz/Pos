<!DOCTYPE html>
<!-- Template by quackit.com -->
<html>
<head>
<body>
    <div class="counter ">
        <div class="row" style="text-align: center;">
            <h2><strong>Ohi and Mahi Departmantal store</strong></h2>
            <h2>Daily Report ({{date('d-m-y',strtotime($start_date))}} - {{date('d-m-y',strtotime($end_date))}})</h2>

        </div>

        <div class="row">
            <table border="1" width="100%">
                <thead>
                <tr>
                  <th>SL</th>
                  <th>Customer Name</th>
                  <th>Invoice No</th>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                    @php
                      $total_amount = 0;    
                    @endphp
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
                        
                    </tr>
                    @php
                      $total_amount += $invoice['payment']['total_amount'];    
                    @endphp
                 @endforeach
                    <tr>
                         <td colspan="5" style="text-align:right">Grand Total:</td>
                         <td>{{$total_amount}}</td>
                    </tr>
                </tbody>
                </tfoot>
              </table>


        </div>

    </div>
				  

</body>
</html>