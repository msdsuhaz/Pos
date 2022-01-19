<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    public function view(){
        $data['alldata'] = Category::all();
        return view('pos.category.view-category',$data);
    }

    public function add(){
        return view('pos.category.add-category');
    }

    public function store(Request $request){
        $data = new Category();
        $data->crated_by = Auth::user()->name;
        $data->updated_by = Auth::user()->name;
        $data->name = $request->name;
        $data->save();
        return redirect()->route('category.view')->with('message','Customer info save successfully');
    }

    public function edit($id){
        $editdata =Category::find($id);
        return view('pos.category.edit-category',compact('editdata'));
    }
    
    public function update(Request $request,$id){
        $data = Category::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('category.view')->with('message','Customer info update successfully');
        
    }
    public function delete($id){
        $data = Category::find($id);
        $data->delete();
        return redirect()->route('category.view')->with('message','Delete data successfully');
    }

}
