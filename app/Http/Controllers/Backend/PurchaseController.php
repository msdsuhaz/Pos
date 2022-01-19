<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\product;
use App\Unit;
use App\supplier;
use App\Purchase;
use Auth;
use DB;
class PurchaseController extends Controller
{
    public function view(){
        $data['alldata'] = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('pos.purchase.view-purchase',$data);
    }

    public function add(){
        $data['products'] = product::all();
        $data['categoryes'] = Category::all();
        $data['suppliers'] = supplier::all();
        $data['units'] = Unit::all();
        return view('pos.purchase.add-purchase',$data);
    }

    public function store(Request $request){
        if($request->category_id ==null){
             return redirect()->back()->with('error','Sorry ! you do not seletct any item');
        }else{
            $coutn_category = count($request->category_id);
            for($i=0;$i<$coutn_category;$i++){
                $data = new Purchase();
                $data->date = date('y-m-d',strtotime($request->date[$i]));
                $data->purchases_no = $request->purchases_no[$i];
                $data->supplier_id = $request->supplier_id[$i];
                $data->category_id = $request->category_id[$i];
                $data->product_id = $request->product_id[$i];
                $data->buying_qty = $request->buying_qty[$i];
                $data->unit_price = $request->unit_price[$i];
                $data->description = $request->description[$i];
                $data->buying_price = $request->buying_price[$i];
                $data->crated_by = Auth::user()->name;
                $data->status  ='0';
                $data->save();
            }
        }
        return redirect()->route('purchase.view')->with('success','purchase info save successfully');
    }

    public function purchaseApprovedList(){
        $data['alldata'] = Purchase::orderBy('date','desc')->orderBy('id','desc')->get();
        return view('pos.purchase.view-purchase-approved',$data);
    }

    public function purchaseApproved($id){
        $purchase =Purchase::find($id);
        $product =product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($product->quantity)) + ((float)($purchase->buying_qty));
        $product->quantity =  $purchase_qty;
        if($product->save()){
            DB::table('purchases')
                  ->where('id',$id)
                  ->update(['status'=>1]);
        }
        return redirect()->route('purchase.approved.list')->with('success','purchase approved successfully');
    }


    public function unapproved($id){
        $purchase =Purchase::find($id);
        $product =product::where('id',$purchase->product_id)->first();
        $purchase_qty = ((float)($product->quantity)) - ((float)($purchase->buying_qty));
        $product->quantity =  $purchase_qty;
            if($product->save()){
                DB::table('purchases')
                      ->where('id',$id)
                      ->update(['status'=>0]);
            }
            return redirect()->route('purchase.approved.list')->with('success','purchase unapproved successfully');
    }

    public function edit($id){
        $data['editdata'] =Purchase::find($id);
        $data['categoryes'] =Category::all();
        $data['suppliers'] =supplier::all();
        $data['units'] = Unit::all();
        return view('pos.purchase.edit-purchase',$data);
    }
    
    public function update(Request $request,$id){
        $data = Purchase::find($id);
        $data->supplier_id = $request->supplier_id;
        $data->category_id = $request->category_id;
        $data->unit_id = $request->unit_id;
        $data->name = $request->name;
        $data->quantity = '0';
        $data->save();
        return redirect()->route('purchase.view')->with('message','purchase info update successfully');
        
    }
    public function delete($id){
        $data = Purchase::find($id);
        $data->delete();
        return redirect()->route('purchase.view')->with('message','Delete data successfully');
    }
   
}
