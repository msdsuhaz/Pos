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
class DefaultController extends Controller
{
    public function getCategory(Request $request){
         $supplier_id = $request->supplier_id;
         $allCategory =product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
         return response()->json($allCategory);
    }

    public function getProduct(Request $request){
         $category_id = $request->category_id;
         $allProudcut = product::where('category_id',$category_id)->get();
         return response()->json($allProudcut);
    }

    public function getStock(Request $request){
         $product_id = $request->product_id;
         $allStock =product::where('id',$product_id)->first()->quantity;
         return response()->json($allStock);
    }
}
