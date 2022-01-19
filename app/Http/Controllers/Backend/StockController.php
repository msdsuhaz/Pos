<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\supplier;
use App\Category;
use PDF;

class StockController extends Controller
{
    public function stockReport(){
        $data['alldata'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('pos.stock.stock-report',$data);
    }

    public function stockReportPrint(){
        $data['alldata'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        $pdf = PDF::loadView('pos.pdf.document.stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function supplierProductWiseStock(){
        $data['suppliers'] = supplier::all();
        $data['products'] = product::all();
        $data['categoryes'] = Category::all();
        return view('pos.stock.supplierProductWiseStock',$data);
    }

    public function supplierWiseReport(Request $request){
        $data['alldata'] = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')
        ->where('supplier_id',$request->supplier_id)->get();
        $pdf = PDF::loadView('pos.pdf.document.supplier-wise-stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
    public function productWiseReport(Request $request){
        $data['alldata'] = Product::where('category_id',$request->category_id)->where('id',$request->product_id)->get();
        $pdf = PDF::loadView('pos.pdf.document.product-wise-stock-report-pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
