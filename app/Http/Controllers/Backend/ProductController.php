<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\product;
use App\Unit;
use App\supplier;
use Auth;

class ProductController extends Controller
{
    public function view(){
        $data['alldata'] = Product::all();
        return view('pos.product.view-product',$data);
    }

    public function add(){
        $data['categoryes'] = Category::all();
        $data['suppliers'] = supplier::all();
        $data['units'] = Unit::all();
        return view('pos.product.add-product',$data);
    }

    public function store(Request $request){
        $data = new product();
        $data->supplier_id = $request->supplier_id;
        $data->category_id = $request->category_id;
        $data->unit_id = $request->unit_id;
        $data->name = $request->name;
        $data->quantity = '0';
        $data->crated_by = Auth::user()->name;
        $data->updated_by = Auth::user()->name;
        $data->save();
        return redirect()->route('product.view')->with('message','Product info save successfully');
    }

    public function edit($id){
        $data['editdata'] =product::find($id);
        $data['categoryes'] =Category::all();
        $data['suppliers'] =supplier::all();
        $data['units'] = Unit::all();
        return view('pos.product.edit-product',$data);
    }
    
    public function update(Request $request,$id){
        $data = product::find($id);
        $data->supplier_id = $request->supplier_id;
        $data->category_id = $request->category_id;
        $data->unit_id = $request->unit_id;
        $data->name = $request->name;
        $data->quantity = '0';
        $data->save();
        return redirect()->route('product.view')->with('message','Product info update successfully');
        
    }
    public function delete($id){
        $data = product::find($id);
        $data->delete();
        return redirect()->route('product.view')->with('message','Delete data successfully');
    }
}
