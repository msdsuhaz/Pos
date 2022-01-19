<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\session;


class UserController extends Controller
{
    public function view(){
        $data['alldata']= User::all();
        return view('pos.user.view-user',$data);
    }

    public function add(){
        
       return view('pos.user.add-user');
    }

    public function store(Request $request){
        $this->validate($request,[
            'usertype'=> 'required',
            'name'=> 'required',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:8',
        ]);
        $editData = new User();
        $editData->usertype = $request->usertype;
        $editData->name = $request->name;
        $editData->email = $request->email;
        $editData->password = bcrypt($request->password);
        $editData->save();
        return redirect()->route('user.view')->with('message','save info successfully');
       
    }

    public function edit($id){
        $editData = User::find($id);
        return view('pos.user.edit-user',compact('editData'));
    }

    public function update(Request $request,$id){
       $editData =User::find($id);
       $editData->usertype = $request->usertype;
       $editData->name = $request->name;
       $editData->email = $request->email;
       $editData->password = bcrypt($request->password);
       $editData->save();

       return redirect()->route('user.view')->with('message','Update info successfully');

    }

    public function delete($id){
        $deleteData = User::find($id);
        $deleteData->delete();
        return redirect()->route('user.view')->with('message','Delete Data successfully');
    }
}
