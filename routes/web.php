<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [ProductController::class, 'dashboard'])->name('welcome');

    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');

    Route::get('/product',  [ProductController::class, 'indexview'])->name('product');
    Route::get('/category',  [ProductController::class, 'categoryview'])->name('category');


    Route::get('/stock', function () {
        return view('stock_list');
    })->name('stock');

    
    Route::get('/paymode', function () {
        return view('pay_mode');
    })->name('paymode');


    Route::get('/product/edit/{id}', [ProductController::class, 'productView'])->name('product.edit');
    Route::get('/stock/update/{id}', [ProductController::class, 'stockView'])->name('stock.edit');
    Route::post('/stock/add/', [ProductController::class, 'addproduct'])->name('stock.add');
    Route::post('/stock/update/', [ProductController::class, 'addstock'])->name('stock.update');

    Route::get('/list', function () {
        return view('productlist');
    })->name('list');

    Route::get('/payment', function () {
        return view('paymentlist');
    })->name('payment');

    Route::get('/payment/save', [ProductController::class, 'paymentindex'])->name('payment.index');
    Route::get('/payment/edit/{id}', [ProductController::class, 'paymentdetail'])->name('payment.edit');
    Route::post('/payment/add', [ProductController::class, 'addpayment'])->name('payment.add');
    Route::put('/payment/update', [ProductController::class, 'editpayment'])->name('payment.update');

    Route::delete('/payment/{id}', [ProductController::class, 'paymentdestroy'])->name('payment.destroy');

    Route::post('/product/add', [ProductController::class, 'store'])->name('product.add');
    Route::post('/category/add', [ProductController::class, 'create'])->name('category.add');
    Route::delete('/category/destroy/{id}', [ProductController::class, 'remove'])->name('category.destroy');

    
    Route::post('/payment/mode', [ProductController::class, 'paymode'])->name('payment.paymode');
    Route::delete('/stock/destroy/{id}', [ProductController::class, 'delete'])->name('stock.destroy');
    Route::delete('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});
