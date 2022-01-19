<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Unit;
use Auth;

class UnitController extends Controller
{
    public function view(){
        $data['alldata'] = Unit::all();
        return view('pos.unit.view-unit',$data);
    }

    public function add(){
        return view('pos.unit.add-unit');
    }

    public function store(Request $request){
        $data = new Unit();
        $data->crated_by = Auth::user()->name;
        $data->updated_by = Auth::user()->name;
        $data->name = $request->name;
        $data->save();
        return redirect()->route('unit.view')->with('message','Customer info save successfully');
    }

    public function edit($id){
        $editdata =Unit::find($id);
        return view('pos.unit.edit-unit',compact('editdata'));
    }
    
    public function update(Request $request,$id){
        $data = Unit::find($id);
        $data->name = $request->name;
        $data->save();
        return redirect()->route('unit.view')->with('message','Customer info update successfully');
        
    }
    public function delete($id){
        $data = Unit::find($id);
        $data->delete();
        return redirect()->route('unit.view')->with('message','Delete data successfully');
    }

}