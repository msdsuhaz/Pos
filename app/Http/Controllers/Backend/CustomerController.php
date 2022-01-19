<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Customer;

class CustomerController extends Controller
{
    public function view(){
        $data['alldata'] = Customer::all();
        return view('pos.customer.view-customer',$data);
    }

    public function add(){
        return view('pos.customer.add-customer');
    }

    public function store(Request $request){
        $data = new Customer();
        $data->crated_by = Auth::user()->name;
        $data->updated_by = Auth::user()->name;
        $data->name = $request->name;
        $data->phone_no = $request->phone_no;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('customer.view')->with('message','Customer info save successfully');
    }

    public function edit($id){
        $editdata =Customer::find($id);
        return view('pos.customer.edit-Customer',compact('editdata'));
    }
    
    public function update(Request $request,$id){
        $data = Customer::find($id);
        $data->name = $request->name;
        $data->phone_no = $request->phone_no;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('customer.view')->with('message','Customer info update successfully');
        
    }
    public function delete($id){
        $data = Customer::find($id);
        $data->delete();
        return redirect()->route('customer.view')->with('message','Delete data successfully');
    }

}
