<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Backend\PosController@index');



Route::prefix('user')->group(function () {
    Route::get('/view', 'Backend\UserController@view')->name('user.view');
    Route::get('/add', 'Backend\UserController@add')->name('user.add');
    Route::post('/store', 'Backend\UserController@store')->name('user.store');
    Route::get('/edit/{id}', 'Backend\UserController@edit')->name('user.edit');
    Route::post('/update/{id}', 'Backend\UserController@update')->name('user.update');
    Route::get('/delete/{id}', 'Backend\UserController@delete')->name('user.delete');
});

  
Route::prefix('profile')->group(function () {
    Route::get('/view', 'Backend\ProfileController@view')->name('profile.view');
    Route::get('/edit', 'Backend\ProfileController@edit')->name('profile.edit');
    Route::post('/update', 'Backend\ProfileController@update')->name('profile.update');
    Route::get('/passwordview', 'Backend\ProfileController@passwordView')->name('password.view');
    Route::post('/passwordupdate', 'Backend\ProfileController@passwordUpdate')->name('update.password');
    
});

Route::prefix('supplier')->group(function () {
    Route::get('/view', 'Backend\SupplierController@view')->name('supplier.view');
    Route::get('/add', 'Backend\SupplierController@add')->name('supplier.add');
    Route::post('/store', 'Backend\SupplierController@store')->name('supplier.store');
    Route::get('/edit/{id}', 'Backend\SupplierController@edit')->name('supplier.edit');
    Route::post('/update/{id}', 'Backend\SupplierController@update')->name('supplier.update');
    Route::get('/delete/{id}', 'Backend\SupplierController@delete')->name('supplier.delete');
});

Route::prefix('customer')->group(function () {
    Route::get('/view', 'Backend\CustomerController@view')->name('customer.view');
    Route::get('/add', 'Backend\CustomerController@add')->name('customer.add');
    Route::post('/store', 'Backend\CustomerController@store')->name('customer.store');
    Route::get('/edit/{id}', 'Backend\CustomerController@edit')->name('customer.edit');
    Route::post('/update/{id}', 'Backend\CustomerController@update')->name('customer.update');
    Route::get('/delete/{id}', 'Backend\CustomerController@delete')->name('customer.delete');
});

Route::prefix('unit')->group(function () {
    Route::get('/view', 'Backend\UnitController@view')->name('unit.view');
    Route::get('/add', 'Backend\UnitController@add')->name('unit.add');
    Route::post('/store', 'Backend\UnitController@store')->name('unit.store');
    Route::get('/edit/{id}', 'Backend\UnitController@edit')->name('unit.edit');
    Route::post('/update/{id}', 'Backend\UnitController@update')->name('unit.update');
    Route::get('/delete/{id}', 'Backend\UnitController@delete')->name('unit.delete');
});

Route::prefix('category')->group(function () {
    Route::get('/view', 'Backend\CategoryController@view')->name('category.view');
    Route::get('/add', 'Backend\CategoryController@add')->name('category.add');
    Route::post('/store', 'Backend\CategoryController@store')->name('category.store');
    Route::get('/edit/{id}', 'Backend\CategoryController@edit')->name('category.edit');
    Route::post('/update/{id}', 'Backend\CategoryController@update')->name('category.update');
    Route::get('/delete/{id}', 'Backend\CategoryController@delete')->name('category.delete');
});

Route::prefix('product')->group(function () {
    Route::get('/view', 'Backend\ProductController@view')->name('product.view');
    Route::get('/add', 'Backend\ProductController@add')->name('product.add');
    Route::post('/store', 'Backend\ProductController@store')->name('product.store');
    Route::get('/edit/{id}', 'Backend\ProductController@edit')->name('product.edit');
    Route::post('/update/{id}', 'Backend\ProductController@update')->name('product.update');
    Route::get('/delete/{id}', 'Backend\ProductController@delete')->name('product.delete');
});


Route::prefix('purchase')->group(function () {
    Route::get('/view', 'Backend\PurchaseController@view')->name('purchase.view');
    Route::get('/add', 'Backend\PurchaseController@add')->name('purchase.add');
    Route::post('/store', 'Backend\PurchaseController@store')->name('purchase.store');
    Route::get('/purchase.approved.list', 'Backend\PurchaseController@purchaseApprovedList')->name('purchase.approved.list');
    Route::get('/purchase.approved/{id}', 'Backend\PurchaseController@purchaseApproved')->name('purchase.approved');
    Route::get('/purchase.unapproved/{id}', 'Backend\PurchaseController@unapproved')->name('purchase.unapproved');
    Route::get('/delete/{id}', 'Backend\PurchaseController@delete')->name('purchase.delete');
});

Route::prefix('invoice')->group(function () {
    Route::get('/view', 'Backend\InvoiceController@view')->name('invoice.view');
    Route::get('/add', 'Backend\InvoiceController@add')->name('invoice.add');
    Route::post('/store', 'Backend\InvoiceController@store')->name('invoice.store');
    Route::get('/invoice.approved.list', 'Backend\InvoiceController@invoiceApprovedList')->name('invoice.approved.list');
    Route::get('/invoice.approved/{id}', 'Backend\InvoiceController@invoiceApproved')->name('invoice.approved');
    Route::get('/invoice.print.list', 'Backend\InvoiceController@invoicePrintList')->name('invoice.print.list');
    Route::get('/invoice.print/{id}', 'Backend\InvoiceController@invoicePrint')->name('invoice.print');
    Route::post('invoice/approved/stock/{id}', 'Backend\InvoiceController@approvedStock')->name('invoice-approved-stock');
    Route::get('/invoice.dailyreport', 'Backend\InvoiceController@invoiceDailyreport')->name('invoice.dailyreport');
    Route::get('/delete/{id}', 'Backend\InvoiceController@delete')->name('invoice.delete');
    Route::get('daily/invoice/generate', 'Backend\InvoiceController@dailyInvoicePdf')->name('daily-invoice-generate');
});

Route::prefix('stock')->group(function () {
    Route::get('/stock/report', 'Backend\StockController@stockReport')->name('stock.report');
    Route::get('printStock/report', 'Backend\StockController@stockReportPrint')->name('printStock-report');
    Route::get('supplier/product/wise/stock', 'Backend\StockController@supplierProductWiseStock')->name('supplier-product-wise-stock');
    Route::get('stock.report.supplier.report.pdf', 'Backend\StockController@supplierWiseReport')->name('stock.report.supplier.report.pdf');
    Route::get('product-wise-stock-report-pdf', 'Backend\StockController@productWiseReport')->name('product-wise-stock-report-pdf');
  
});

Route::get('/get-category', 'Backend\DefaultController@getCategory')->name('get-category');
Route::get('/get-product', 'Backend\DefaultController@getProduct')->name('get-product');
Route::get('/get-Stock', 'Backend\DefaultController@getStock')->name('get-product-stock');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');








