<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\product;
use App\Unit;
use App\supplier;
use App\Purchase;
use App\invoice;
use App\Customer;
use App\invoiceDetails;
use App\payment;
use App\paymentDetails;
use Auth;
use DB;
use PDF;

class InvoiceController extends Controller
{
    public function view(){
        $data['alldata'] = invoice::orderBy('date','desc')->where('status','1')->orderBy('id','desc')->get();
        return view('pos.invoice.view-invoice',$data);
    }

    public function add(){
       
        $data['categoryes'] = Category::all();
        $invoice_data=invoice::orderBy('id','desc')->first();
        if($invoice_data==null){
            $firstReg ='0';
            $data['invoice_no']=$firstReg+1;
        }else{
            $invoice_data=invoice::orderBy('id','desc')->first()->invoice_no;
            $data['invoice_no'] = $invoice_data+1;
        }
        $data['castomers'] = Customer::all();
        return view('pos.invoice.add-invoice',$data);
    }

    public function store(Request $request){

        if($request->category_id==null){
             return redirect()->back()->with('error','Sorry You dont select any Category and Product');
        }else{
             if($request->paid_amount>$request->estimated_amount){
                return redirect()->back()->with('error','Sorry Paid Amount is maximum then total price');
             }else{
                 $invoice = new invoice();
                 $invoice->invoice_no = $request->invoice_no;
                 $invoice->date = date('Y-m-d', strtotime($request->date));
                 $invoice->description = $request->description;
                 $invoice->status = '0';
                 $invoice->created_by = Auth::user()->name;
                 DB::transaction(function () use($request, $invoice){
                     if($invoice->save()){
                         $category_count = count($request->category_id);
                         for($i=0;$i<$category_count;$i++){
                            $invioce_details = new invoiceDetails();
                            $invioce_details->date = date('Y-m-d', strtotime($request->date));
                            $invioce_details->invoice_id = $invoice->id;
                            $invioce_details->category_id = $request->category_id[$i];
                            $invioce_details->product_id = $request->product_id[$i];
                            $invioce_details->selling_qty = $request->selling_qty[$i];
                            $invioce_details->unit_price = $request->unit_price[$i];
                            $invioce_details->selling_price = $request->selling_price[$i];
                            $invioce_details->status = '1';
                            $invioce_details->save();
                     }
                         if($request->customer_id=='0'){
                              $castomer = new Customer();
                              $castomer->name = $request->name;
                              $castomer->phone_no = $request->phone_no;
                              $castomer->address = $request->address;
                              $castomer->save();
                              $customer_id =$castomer->id;
                              
                         }else{
                              $customer_id = $request->customer_id;
                         }
                         $payment = new payment();
                         $paymentDetails = new paymentDetails();
                         $payment->invoice_id = $invoice->id;
                         $payment->customer_id = $customer_id;
                         $payment->paid_status = $request->paid_status;
                         $payment->discount_amount = $request->discount_amount;
                         $payment->total_amount = $request->estimated_amount;

                         if($request->paid_status== 'full_paid'){
                             $payment->paid_amount =$request->estimated_amount;
                             $payment->due_amount  = '0';
                             $paymentDetails->current_paid_ammount  = $request->estimated_amount;
                         }elseif($request->paid_status== 'full_due'){
                            $payment->paid_amount ='0';
                            $payment->due_amount  = $request->estimated_amount;
                            $paymentDetails->current_paid_ammount  = '0';

                         }elseif($request->paid_status== 'partical_paid'){
                            $payment->paid_amount =$request->paid_amount ;
                            $payment->due_amount  = $request->estimated_amount - $request->paid_amount;
                            $paymentDetails->current_paid_ammount  = $request->paid_amount;
                         }
                         $payment->save();
                           
                         $paymentDetails->invoice_id =  $invoice->id ;
                         $paymentDetails->date = date('Y-m-d', strtotime($request->date));
                         $paymentDetails->save();

                     }
                 });
             }
        }
        return redirect()->route('invoice.approved.list')->with('success','Data info save successfully');
    }

    public function invoiceApprovedList(){
        $data['alldata'] = invoice::orderBy('date','desc')->where('status','0')->orderBy('id','desc')->get();
        return view('pos.invoice.view-invoice-approvedlist',$data);
    }

    public function invoiceApproved($id){
        $data['invoice'] =invoice::with(['invoiceDetails'])->find($id);
        return view('pos.invoice.view-invoice-approved',$data);
    }

    public function approvedStock(Request $request,$id){
             foreach($request->selling_qty as $key=>$val){
                 $invioce_details =invoiceDetails::where('id',$key)->first();
                 $product = product::where('id',$invioce_details->product_id)->first();
                 if($product->quantity < $request->selling_qty[$key]){
                    return redirect()->back()->with('error','Sorry you approved maximum value');
                 }

             }
             $invoice = invoice::find($id);
             $invoice->approved_by=Auth::user()->id;
             $invoice->status ='1';

             DB::transaction(function () use ($request,$invoice,$id){
                 foreach($request->selling_qty as $key=>$val){
                    $invioce_details =invoiceDetails::where('id',$key)->first();
                    $product = product::where('id',$invioce_details->product_id)->first();
                    $product->quantity =((float)$product->quantity)-((float)$request->selling_qty[$key]);
                    $product->save();
                 }
                 $invoice->save();
             });
             return redirect()->route('invoice.approved.list')->with('success','invoice successfully approved');
    }

    public function delete($id){
        $invoice =invoice::find($id);
        $invoice->delete();
        invoiceDetails::where('invoice_id',$invoice->id)->delete();
        payment::where('invoice_id',$invoice->id)->delete();
        paymentDetails::where('invoice_id',$invoice->id)->delete();

        return redirect()->route('invoice.approved.list')->with('message','Delete data successfully');
    }

    public function invoicePrintList(){
        $data['alldata'] = invoice::orderBy('date','desc')->where('status','1')->orderBy('id','desc')->get();
        return view('pos.invoice.view-invoice-print',$data);
    }

    public function invoicePrint($id){
        $data['invoice'] = invoice::with(['invoiceDetails'])->find($id);
        $pdf = PDF::loadView('pos.pdf.document.invoicePdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function invoiceDailyreport(){
        return view('pos.invoice.daily-invoice-report');
    }

    public function dailyInvoicePdf(Request $request){
        $sdate = date('Y-m-d',strtotime($request->start_date));
        $edate = date('Y-m-d',strtotime($request->end_date));
        $data['alldata'] = invoice::whereBetween('date',[$sdate,$edate])->where('status','1')->get();
        $data['start_date'] = date('Y-m-d',strtotime($request->start_date));
        $data['end_date'] = date('Y-m-d',strtotime($request->end_date));
        $pdf = PDF::loadView('pos.pdf.document.daily-invoice-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    
   
  
}
