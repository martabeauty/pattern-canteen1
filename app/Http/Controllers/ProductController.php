<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\PayMode;
use App\Models\Payment;
use App\Models\Stock;

class ProductController extends Controller
{
    public function indexview(Request $request)
    {
        $category = Category::all()->where('is_active', '1');
        return view('product', compact('category'));
    }

    public function dashboard(Request $request)
    {
       
       
        $selltoday = Stock::select('buyin', 'sellout')->where('date', date('Y-m-d'))->get();
        if (count($selltoday) > 0) {
            foreach ($selltoday as $val) {
                $sumout[] = $val['sellout'];
                $sumin[] = $val['buyin'];
            }
            $todayout = array_sum($sumout);
            $todayin = array_sum($sumin);
        } else {
            $todayout = 0;
            $todayin = 0;
        }

        $prev_date = date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day'));

        $sellyesterday = Stock::select('buyin', 'sellout')->where('date', $prev_date)->get();

        if (count($sellyesterday) > 0) {

            foreach ($sellyesterday as $val) {
                $sumyout[] = $val['sellout'];
                $sumyin[] = $val['buyin'];
            }
            $yesout = array_sum($sumyout);
            $yesin = array_sum($sumyin);
        } else {
            $yesout = 0;
            $yesin = 0;
        }
        $stockcount = Stock::select('id')->count();
        $productactive = Product::select('id')->where('in_stock', 1)->count();
        $productinactive = Product::select('id')->where('in_stock', 0)->count();
        $catactive = Category::select('id')->where('is_active', 1)->count();
        $catinactive = Category::select('id')->where('is_active', 0)->count();
        $stockcount = Stock::select('id')->count();

        $upitoday11 = PayMode::select('upi')->where('date', date('Y-m-d'))->count();
        $upitoday22 = PayMode::select('cash')->where('date', date('Y-m-d'))->count();
        if ($upitoday11 > 0) {
            $upitoday10 = PayMode::select('upi')->where('date', date('Y-m-d'))->get();

            $upitoday1 = $upitoday10[0]['upi'];
        } else {
            $upitoday1 = 0;
        }
        if ($upitoday22 > 0) {
            $upitoday20 = PayMode::select('cash')->where('date', date('Y-m-d'))->get();
            $upitoday2 = $upitoday20[0]['cash'];
        } else {
            $upitoday2 = 0;
        }

        $upiyesterdays = date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day'));
        $upiyesterday11 = PayMode::select('upi')->where('date', $upiyesterdays)->count();
        $upiyesterday22 = PayMode::select('cash')->where('date', $upiyesterdays)->count();

        if ($upiyesterday11 > 0) {
            $upiyesterday10 = PayMode::select('upi')->where('date', $upiyesterdays)->get();
            $upiyesterday1 = $upiyesterday10[0]['upi'];
        } else {
            $upiyesterday1 = 0;
        }
        if ($upiyesterday22 > 0) {
            $upiyesterday20 = PayMode::select('cash')->where('date', $upiyesterdays)->get();
            $upiyesterday2 = $upiyesterday20[0]['cash'];
        } else {
            $upiyesterday2 = 0;
        }
        $data = [
            "selltoday" => $todayout, "buyin" => $todayin,
            "sellyesterday" => $yesout, "buyyesterday" => $yesin,
            "upitoday" => $upitoday1, "cashtoday" => $upitoday2,
            "stock" => $stockcount, "productactive" => $productactive,
            "productinactive" => $productinactive,
            "upiyesterday" => $upiyesterday1, "cashyesterday" => $upiyesterday2,
            "catactive" => $catactive, "catinactive" => $catinactive
        ];
        return view('dashboard', compact('data'));
    }

    public function categoryview(Request $request)
    {
        $category = Category::all()->where('is_active', '1');
        return view('category', compact('category'));
    }

    public function productView($id)
    {
        $product = Product::find($id);
        return view('stock', compact('product'));
    }

    public function productAdd(Request $request)
    {

        return view('addproduct');
    }

    public function stockView($id)
    {

        $product = Stock::select(
            'stocks.id',
            'stocks.product_id',
            'stocks.buyin',
            'stocks.sellout',
            'stocks.qty',
            'products.title',
            'products.in_stock',
            'products.quantity',
            'products.price_per_item',
            'stocks.date'
        )
            ->where('stocks.id', $id)->join('products', 'stocks.product_id', '=', 'products.id')->get();
        return view('stockupdate', compact('product'));
    }





    public function editpayment(Request $request)
    {


        if (($request->date != '') && ($request->amount != '') && ($request->mode != '')) {


            $sel = Payment::select("*")->where('mode', $request->mode)->where('date', $request->date)->count();
            $sel2 = Payment::select("*")->where('mode', $request->mode)->where('date', $request->date)->get();
            $sumout = [];
          
            

            $selltoday = Stock::select('buyin', 'sellout')->where('date', $request->date)->get();
            if (count($selltoday) > 0) {
                foreach ($selltoday as $val) {
                    $sumout[] = $val['sellout'];
                    $sumin[] = $val['buyin'];
                }
                $todayout = array_sum($sumout);
                $todayin = array_sum($sumin);
            } else {
                return response()->json(['msg' => 'no product sell out on ' . $request->date, 'status' => '0']);
            }
            if ($todayout > $request->amount) {

                if ($sel > 0) {
                    //  $sel1 = Stock::select("product_id")->where('product_id', $request->id)->where('date', $request->date)->get();

                    if ($request->mode == "upi") {
                        $selcash = Payment::select("*")->where('mode', 'cash')->where('date', $request->date)->count();
                        if ($selcash > 0) {
                            Payment::where('date', $request->date)
                                ->where('mode', $request->mode)
                                ->update([
                                    'amount' => $request->amount,

                                ]);


                            Payment::where('date', $request->date)
                                ->where('mode', 'cash')
                                ->update([
                                    'amount' => (float)($todayout - $request->amount),

                                ]);
                        } else {

                            $stock = new Payment;
                            $stock->amount =  (float)($todayout - $request->amount);
                            $stock->mode = 'cash';
                            $stock->date = $request->date;
                            $stock->save();
                        }
                    } else {
                        $selcash = Payment::select("*")->where('mode', 'upi')->where('date', $request->date)->count();
                        if ($selcash > 0) {
                            Payment::where('date', $request->date)
                                ->where('mode', $request->mode)
                                ->update([
                                    'amount' => $request->amount,

                                ]);


                            Payment::where('date', $request->date)
                                ->where('mode', 'upi')
                                ->update([
                                    'amount' => (float)($todayout - $request->amount),

                                ]);
                        } else {
                            $stock = new Payment;
                            $stock->amount =  (float)($todayout - $request->amount);
                            $stock->mode = 'upi';
                            $stock->date = $request->date;
                            $stock->save();
                        }
                    }
                    return response()->json(['msg' => 'Data has been updated', 'status' => '1']);
                } else {




                    $stock = new Payment;
                    $stock->amount = $request->amount;
                    $stock->mode = $request->mode;
                    $stock->date = $request->date;
                    $stock->save();


                    if ($request->mode == "upi") {
                        $stock = new Payment;
                        $stock->amount = (float)($todayout - $request->amount);
                        $stock->mode = 'cash';
                        $stock->date = $request->date;
                        $stock->save();
                    } else {
                        $stock = new Payment;
                        $stock->amount = (float)($todayout - $request->amount);
                        $stock->mode = 'upi';
                        $stock->date = $request->date;
                        $stock->save();
                    }

                    return response()->json(['msg' => 'Data has been saved', 'status' => '2']);
                }
            } else {

                return response()->json(['msg' => 'amount is greater than total sell out', 'status' => '0']);
            }
        } else {

            return response()->json(['msg' => 'All fields required', 'status' => '0']);
        }
    }



    public function addpayment(Request $request)
    {


        if (($request->date != '') && ($request->amount != '') && ($request->mode != '')) {


            $sel = Payment::select("*")->where('mode', $request->mode)->where('date', $request->date)->count();
            $sel2 = Payment::select("*")->where('mode', $request->mode)->where('date', $request->date)->get();
            $sumout = [];
            $selltoday = Stock::select('buyin', 'sellout')->where('date', $request->date)->get();
            if (count($selltoday) > 0) {
                foreach ($selltoday as $val) {
                    $sumout[] = $val['sellout'];
                    $sumin[] = $val['buyin'];
                }
                $todayout = array_sum($sumout);
                $todayin = array_sum($sumin);
            } else {
                return response()->json(['msg' => 'no product sell out on ' . $request->date, 'status' => '0']);
            }
            if ($todayout > $request->amount) {

                if ($sel > 0) {
                    //  $sel1 = Stock::select("product_id")->where('product_id', $request->id)->where('date', $request->date)->get();

                    if ($request->mode == "upi") {
                        $selcash = Payment::select("*")->where('mode', 'cash')->where('date', $request->date)->count();
                        if ($selcash > 0) {
                            Payment::where('date', $request->date)
                                ->where('mode', $request->mode)
                                ->update([
                                    'amount' => $request->amount,

                                ]);


                            Payment::where('date', $request->date)
                                ->where('mode', 'cash')
                                ->update([
                                    'amount' => (float)($todayout - $request->amount),

                                ]);
                        } else {

                            $stock = new Payment;
                            $stock->amount =  (float)($todayout - $request->amount);
                            $stock->mode = 'cash';
                            $stock->date = $request->date;
                            $stock->save();
                        }
                    } else {
                        $selcash = Payment::select("*")->where('mode', 'upi')->where('date', $request->date)->count();
                        if ($selcash > 0) {
                            Payment::where('date', $request->date)
                                ->where('mode', $request->mode)
                                ->update([
                                    'amount' => $request->amount,

                                ]);


                            Payment::where('date', $request->date)
                                ->where('mode', 'upi')
                                ->update([
                                    'amount' => (float)($todayout - $request->amount),

                                ]);
                        } else {
                            $stock = new Payment;
                            $stock->amount =  (float)($todayout - $request->amount);
                            $stock->mode = 'upi';
                            $stock->date = $request->date;
                            $stock->save();
                        }
                    }
                    return response()->json(['msg' => 'Data has been updated', 'status' => '1']);
                } else {




                    $stock = new Payment;
                    $stock->amount = $request->amount;
                    $stock->mode = $request->mode;
                    $stock->date = $request->date;
                    $stock->save();


                    if ($request->mode == "upi") {
                        $stock = new Payment;
                        $stock->amount = (float)($todayout - $request->amount);
                        $stock->mode = 'cash';
                        $stock->date = $request->date;
                        $stock->save();
                    } else {
                        $stock = new Payment;
                        $stock->amount = (float)($todayout - $request->amount);
                        $stock->mode = 'upi';
                        $stock->date = $request->date;
                        $stock->save();
                    }

                    return response()->json(['msg' => 'Data has been saved', 'status' => '2']);
                }
            } else {

                return response()->json(['msg' => 'amount is greater than total sell out', 'status' => '0']);
            }
        } else {

            return response()->json(['msg' => 'All fields required', 'status' => '0']);
        }
    }


    public function addproduct(Request $request)
    {


        if (($request->date == null) || ($request->qty == null) || ($request->date == '') || ($request->qty == '')) {

            return response()->json(['msg' => 'please enter required field', 'status' => '0']);
        } else {


            $sel = Stock::select("*")->where('product_id', $request->id)->where('date', $request->date)->count();
            $sel2 = Product::select("*")->where('id', $request->id)->get();
            $sel3 = Stock::select("*")->where('product_id', $request->id)->where('date', $request->date)->get();
          
            
            $payment = Payment::select("*")->where('date', $request->date)->count();
             
            $payment1 = Payment::select("*")->where('date', $request->date)->get();
            if(($sel2[0]->quantity)>=($request->qty))
            {

            if ($sel > 0) {
                //  $sel1 = Stock::select("product_id")->where('product_id', $request->id)->where('date', $request->date)->get();

                Stock::where('date', $request->date)
                    ->update([
                        'buyin' => $request->buyin,
                        //  'sellout' => $request->sellout,
                        //   'qty' => $request->qty,
                        'sellout' => (($request->qty) * ($sel2[0]['price_per_item'])),
                        'qty' => $request->qty
                    ]);


                    $countstock=Stock::select('price')->where('date', $request->date)->count();
                    if($countstock>0)
                    {
                
                        $paymentSums=Stock::select('sellout')->where('date','=',$request->date)->get();
                        foreach(json_decode($paymentSums,true) as $key=>$val)
                        {
                            $price[]=$paymentSums[$key]['sellout'];
                        }
                
                        $paymentSum=array_sum($price);

                        $countstockpayment=Payment::select('amount')->where('date', $request->date)->count();
                        if($countstockpayment>0)
                        {
                            Payment::where('date','=',$request->date)
                            ->update(['amount' => ($paymentSum)]);
                        }
                        else{
                            $payments=new Payment;
                        $payments->date = $request->date;
                        $payments->mode = "cash";
                        $payments->amount = ($paymentSum);
                        $payments->save();


                            $paymode = new paymode;
                            $paymode->date = $request->date;
                            $paymode->cash = 0;
                            $paymode->upi = 0;
                            $paymode->pending = 0;
                            $paymode->save();

                        }

                    }
                    else{
                            $paymentSum=0;
                            $countstockpayment=Payment::select('amount')->where('date', $request->date)->count();
                            if($countstockpayment>0)
                            {
                                Payment::where('date','=',$request->date)
                                ->update(['amount' => ($paymentSum)]);
                            }
                            else{
                                    $payments=new Payment;
                                    $payments->date = $request->date;
                                    $payments->mode = "cash";
                                    $payments->amount = ($paymentSum);
                                    $payments->save();


                            $paymode = new paymode;
                            $paymode->date = $request->date;
                            $paymode->cash = 0;
                            $paymode->upi = 0;
                            $paymode->pending = 0;
                            $paymode->save();

                                }
                        }

                    /**
                     * 
                     */
                        if($sel3[0]->qty<$request->qty)
                        {
                            $remaining=$request->qty-$sel3[0]->qty;
                        }
                        if($sel3[0]->qty>$request->qty)
                        {
                            $remaining=$request->qty-$sel3[0]->qty;
                        }
                     /**
                      * 
                      */
                      if($sel3[0]->qty!=$request->qty)
                      {
                    Product::where('id', $request->id)
                    ->update([
                        'quantity' => ($sel2[0]->quantity-$remaining)
                    ]);
                  //  if($payment<=0)
                  //  {
                    /* 
                        $payments=new Payment;
                        $payments->date = $request->date;
                       $payments->mode = "cash";
                    $payments->amount = (($request->qty) * ($sel2[0]['price_per_item']));
                       $payments->save();
               */
                        

                  //  }
                  //  else{
                        /*
                        Payment::where('date',  $request->date)
                    ->update([
                        'amount' => ($payment1[0]->amount-($sel2[0]->price_per_item*$remaining))
                    ]);
                    */
                //    }
                }
                return response()->json(['msg' => 'Data has been updated', 'status' => '1']);
            } else {

                $stock = new Stock;
                $stock->product_id = $request->id;
                $stock->qty = $request->qty;
                $stock->buyin = $request->buyin;
                $stock->sellout = (($request->qty) * ($sel2[0]['price_per_item']));
                $stock->date = $request->date;
                $stock->save();
                Product::where('id', $request->id)
                ->update([
                    'quantity' => ($sel2[0]->quantity-$request->qty)
                ]);



                
                $paymentSums=Stock::select('sellout')->where('date','=',$request->date)->get();
                foreach(json_decode($paymentSums,true) as $key=>$val)
                {
                    $price[]=$paymentSums[$key]['sellout'];
                }
        
                $paymentSum=array_sum($price);

                $countstockpayment=Payment::select('amount')->where('date', $request->date)->count();
                if($countstockpayment>0)
                {
                    Payment::where('date','=',$request->date)
                    ->update(['amount' => ($paymentSum)]);
                }
                else{
                    $payments=new Payment;
                $payments->date = $request->date;
                $payments->mode = "cash";
                $payments->amount = ($paymentSum);
                $payments->save();


                        $paymode = new paymode;
                        $paymode->date = $request->date;
                        $paymode->cash = 0;
                        $paymode->upi = 0;
                        $paymode->pending = 0;
                        $paymode->save();

                }


                return response()->json(['msg' => 'Data has been saved', 'status' => '2']);
            }
        }
        else{
            return response()->json(['msg' => 'quantity is exceeded', 'status' => '0']);
       
        }
        }
    }

    public function paymentindex(Request $request)
    {
        return view('payment');
    }

    public function paymentdetail($id)
    {

        $payment = Payment::findOrFail($id);
        $paymodecount = PayMode::select("*")->where('date',$payment->date)->count();
        if($paymodecount>0)
        {
        $paymode = PayMode::select("*")->where('date',$payment->date)->get();
        }
        else{
            $paymode = [["cash"=>0,"upi"=>0,"pending"=>0]];
        }
        return view('paymentdetail', compact('payment','paymode'));
    }

    public function addstock(Request $request)
    {

        if (($request->date == null) || ($request->qty == null) || ($request->date == '') || ($request->qty == '')) {

            return response()->json(['msg' => 'please enter required field', 'status' => '0']);
        } else {

            
            $sel = Stock::select("*")->where('id', $request->id)->where('date', $request->date)->count();
            $sel1 = Stock::select("*")->where('id', $request->id)->where('date', $request->date)->get();
            $sel2 = Product::select("*")->where('id', $sel1[0]['product_id'])->get();

           

            if(($sel2[0]->quantity)>=($request->qty))
            {
            if ($sel > 0) {
                Stock::where('id', $request->id)
                    ->update([
                        'buyin' => $request->buyin,
                        // 'sellout' => $request->sellout,
                        'sellout' => (($request->qty) * ($sel2[0]['price_per_item'])),
                        'qty' => $request->qty
                    ]);


                      /**
                     * 
                     */
                         
                    if($sel1[0]->qty<$request->qty)
                    {
                        $remaining=$request->qty-$sel1[0]->qty;
                    }
                    if($sel1[0]->qty>$request->qty)
                    {
                        $remaining=$request->qty-$sel1[0]->qty;
                    }
                 /**
                  * 
                  */
                  if($sel1[0]->qty!=$request->qty)
                  {
                Product::where('id', $sel1[0]['product_id'])
                ->update([
                    'quantity' => ($sel2[0]->quantity-$remaining)
                ]);
            }


                $countstock=Stock::select('price')->where('date', $request->date)->count();
                    if($countstock>0)
                    {
                
                        $paymentSums=Stock::select('sellout')->where('date','=',$request->date)->get();
                        foreach(json_decode($paymentSums,true) as $key=>$val)
                        {
                            $price[]=$paymentSums[$key]['sellout'];
                        }
                
                        $paymentSum=array_sum($price);

                        $countstockpayment=Payment::select('amount')->where('date', $request->date)->count();
                        if($countstockpayment>0)
                        {
                            Payment::where('date','=',$request->date)
                            ->update(['amount' => ($paymentSum)]);
                        }
                        else{
                            $payments=new Payment;
                        $payments->date = $request->date;
                        $payments->mode = "cash";
                        $payments->amount = ($paymentSum);
                        $payments->save();


                            $paymode = new paymode;
                            $paymode->date = $request->date;
                            $paymode->cash = 0;
                            $paymode->upi = 0;
                            $paymode->pending = 0;
                            $paymode->save();

                        }

                    }
                    else{
                            $paymentSum=0;
                            $countstockpayment=Payment::select('amount')->where('date', $request->date)->count();
                            if($countstockpayment>0)
                            {
                                Payment::where('date','=',$request->date)
                                ->update(['amount' => ($paymentSum)]);
                            }
                            else{
                                    $payments=new Payment;
                                    $payments->date = $request->date;
                                    $payments->mode = "cash";
                                    $payments->amount = ($paymentSum);
                                    $payments->save();


                            $paymode = new paymode;
                            $paymode->date = $request->date;
                            $paymode->cash = 0;
                            $paymode->upi = 0;
                            $paymode->pending = 0;
                            $paymode->save();
                                }
                        }

                return response()->json(['msg' => 'Data has been updated', 'status' => '1']);
            } else {
                $stock = new Stock;
                $stock->product_id = $request->id;
                $stock->buyin = $request->buyin;
                $stock->qty = $request->qty;
                $stock->sellout = (($request->qty) * ($sel2[0]['price_per_item']));
                $stock->date = $request->date;
                $stock->save();

                Product::where('id',$sel1[0]['product_id'])
                ->update([
                    'quantity' => ($sel2[0]->quantity-$request->qty)
                ]);


                $countstock=Stock::select('price')->where('date', $request->date)->count();
                    if($countstock>0)
                    {
                
                        $paymentSums=Stock::select('sellout')->where('date','=',$request->date)->get();
                        foreach(json_decode($paymentSums,true) as $key=>$val)
                        {
                            $price[]=$paymentSums[$key]['sellout'];
                        }
                
                        $paymentSum=array_sum($price);

                        $countstockpayment=Payment::select('amount')->where('date', $request->date)->count();
                        if($countstockpayment>0)
                        {
                            Payment::where('date','=',$request->date)
                            ->update(['amount' => ($paymentSum)]);
                        }
                        else{
                            $payments=new Payment;
                        $payments->date = $request->date;
                        $payments->mode = "cash";
                        $payments->amount = ($paymentSum);
                        $payments->save();


                            $paymode = new paymode;
                            $paymode->date = $request->date;
                            $paymode->cash = 0;
                            $paymode->upi = 0;
                            $paymode->pending = 0;
                            $paymode->save();

                        }

                    }
                    else{
                            $paymentSum=0;
                            $countstockpayment=Payment::select('amount')->where('date', $request->date)->count();
                            if($countstockpayment>0)
                            {
                                Payment::where('date','=',$request->date)
                                ->update(['amount' => ($paymentSum)]);
                            }
                            else{
                                    $payments=new Payment;
                                    $payments->date = $request->date;
                                    $payments->mode = "cash";
                                    $payments->amount = ($paymentSum);
                                    $payments->save();


                            $paymode = new paymode;
                            $paymode->date = $request->date;
                            $paymode->cash = 0;
                            $paymode->upi = 0;
                            $paymode->pending = 0;
                            $paymode->save();
                                }
                        }

                return response()->json(['msg' => 'Data has been saved', 'status' => '2']);
            }
        }
        else{
            
            return response()->json(['msg' => 'quantity is exceeded', 'status' => '0']);
        }
        }
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if (($request->title == null) || ($request->stock == null)) {

            return response()->json(['msg' => 'please enter required field <br> title , stock are mandetory', 'status' => '0']);
        } else {
            $stock = new Category;
            $stock->title = $request->title;
            $stock->description = $request->des;
            $stock->is_active = $request->stock;
            $stock->save();
            return response()->json(['msg' => 'Data has been saved', 'status' => '2']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (($request->title == null) || ($request->stock == null)
            || ($request->cat == '') || ($request->price == '')
        ) {

            return response()->json(['msg' => 'please enter required field <br> title , stock, category, price are mandetory', 'status' => '0']);
        } else if (($request->qty != null) || ($request->qty != '')) {
            if ((is_numeric($request->price) != 1) || (is_numeric($request->qty) != 1)) {

                return response()->json(['msg' => 'only number are required in price and quantity', 'status' => '1']);
            } else {
                $stock = new Product;
                $stock->title = $request->title;
                $stock->description = $request->des;
                $stock->in_stock = $request->stock;
                $stock->quantity = $request->qty;
                $stock->price_per_item = $request->price;
                $stock->category_id = $request->cat;
                $stock->save();
                return response()->json(['msg' => 'Data has been saved', 'status' => '2']);
            }
        } else if (($request->qty == null) || ($request->qty == '')) {
            if ((is_numeric($request->price) != 1)) {

                return response()->json(['msg' => 'only number are required in price', 'status' => '1']);
            } else {
                $stock = new Product;
                $stock->title = $request->title;
                $stock->description = $request->des;
                $stock->in_stock = $request->stock;
                $stock->quantity = $request->qty;
                $stock->price_per_item = $request->price;
                $stock->category_id = $request->cat;
                $stock->save();
                return response()->json(['msg' => 'Data has been saved', 'status' => '2']);
            }
        } else {
            $stock = new Product;
            $stock->title = $request->title;
            $stock->description = $request->des;
            $stock->in_stock = $request->stock;
            $stock->quantity = $request->qty;
            $stock->price_per_item = $request->price;
            $stock->category_id = $request->cat;
            $stock->save();
            return response()->json(['msg' => 'Data has been saved', 'status' => '2']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Stock::where('product_id', $id)->delete();
        Product::find($id)->delete();
        $category = Category::all()->where('is_active', '1');
        // return view('product', compact('category'));
        return redirect()->route('product', compact('category'));
    }


    public function paymentdestroy($id)
    {
        $payment=Payment::find($id);
        paymode::where('date',$payment->date)->delete();
        Payment::find($id)->delete();
        return redirect()->route('payment');
    }

    public function delete($id)
    {
        $sel=stock::find($id);
        $sel2=Product::find($sel['product_id']);

        Product::where('id', $sel['product_id'])
        ->update([
            'quantity' => ($sel2['quantity']+$sel['qty'])
        ]);
        Stock::find($id)->delete();
        return view('stock_list');
    }
    public function remove($id)
    {
        $ids = [];
        $sel = Product::select('id', 'category_id')->where('category_id', $id)->get();
        foreach ($sel as $val) {
            $ids[] = $val['id'];
        }

        Stock::whereIn('product_id', $ids)->delete();
        Product::whereIn('id', $ids)->delete();
        Category::find($id)->delete();

        $category = Category::all()->where('is_active', '1');
        //return redirect()->view('category');
        return redirect('/category');
    }

    public function paymode(Request $request)
    {

        $paymode = PayMode::select("*")->where('date',$request->date)->count();
        if($paymode>0)
        {
            if($request->amount>=($request->cash+$request->upi+$request->pending))
            {
                if(($request->cash<=0)&&($request->upi<=0)&&(($request->pending<=0)||($request->pending=="")))
                {
                    $cash=$request->cash;
                    $pending=$request->pending;
                    $upi=$request->upi;
                }

                if(($request->cash<=0)&&($request->upi>0)&&(($request->pending<=0)||($request->pending=="")))
                {
                    $cash=$request->cash;
                    $pending=$request->amount-$request->upi;
                    $upi=$request->upi;
                }

                if(($request->cash>0)&&($request->upi<=0)&&(($request->pending<=0)||($request->pending=="")))
                {
                    $cash=$request->cash;
                    $pending=$request->amount-$request->cash;
                    $upi=$request->upi;
                }

                if(($request->cash>0)&&($request->upi>0))
                {
                    $cash=$request->cash;
                    $pending=$request->amount-($request->cash+$request->upi);
                    $upi=$request->upi;
                }

                PayMode::where('date', $request->date)
                ->update([
                            'cash' => $cash,
                            'upi' => $upi,
                            'pending' => $pending
                        ]);
                return response()->json(['msg' => 'Data has been updated', 'status' => '1']);
        }
        else{
            return response()->json(['msg' => 'Input is exceeded to amount', 'status' => '0']);
        }
            
            
        }
        else{

            if(($request->cash<=0)&&($request->upi<=0)&&(($request->pending<=0)||($request->pending=="")))
            {
                $cash=$request->cash;
                $pending=$request->pending;
                $upi=$request->upi;
            }

            if(($request->cash<=0)&&($request->upi>0)&&(($request->pending<=0)||($request->pending=="")))
            {
                $cash=$request->cash;
                $pending=$request->amount-$request->upi;
                $upi=$request->upi;
            }
///
            if(($request->cash>0)&&($request->upi<=0)&&(($request->pending<=0)||($request->pending=="")))
            {
                $cash=$request->cash;
                $pending=$request->amount-$request->cash;
                $upi=$request->upi;
            }

            if(($request->cash>0)&&($request->upi>0))
            {
                $cash=$request->cash;
                $pending=$request->amount-($request->cash+$request->upi);
                $upi=$request->upi;
            }

            $paymode = new PayMode;
            $paymode->cash = $cash;
            $paymode->upi = $upi;
            $paymode->pending = $pending;
            $paymode->date = $request->date;
            $paymode->save();
            
            return response()->json(['msg' => 'Data has been saved', 'status' => '2']);
        }
    }
}
