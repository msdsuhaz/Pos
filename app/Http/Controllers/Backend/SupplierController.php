<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\supplier;
use Auth;

class SupplierController extends Controller
{
    public function view(){
        $data['alldata'] = supplier::all();
        return view('pos.supplier.view-supplier',$data);
    }

    public function add(){
        return view('pos.supplier.add-supplier');
    }

    public function store(Request $request){
        $data = new supplier();
        $data->crated_by = Auth::user()->name;
        $data->updated_by = Auth::user()->name;
        $data->name = $request->name;
        $data->phone_no = $request->phone_no;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('supplier.view')->with('message','supplier info save successfully');
    }

    public function edit($id){
        $editdata =supplier::find($id);
        return view('pos.supplier.edit-supplier',compact('editdata'));
    }
    
    public function update(Request $request,$id){
        $data = supplier::find($id);
        $data->name = $request->name;
        $data->phone_no = $request->phone_no;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
        return redirect()->route('supplier.view')->with('message','supplier info update successfully');
        
    }
    public function delete($id){
        $data = supplier::find($id);
        $data->delete();
        return redirect()->route('supplier.view')->with('message','Delete data successfully');
    }

}
