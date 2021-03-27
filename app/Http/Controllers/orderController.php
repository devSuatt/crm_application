<?php

namespace App\Http\Controllers;

use App\orderModel;
use App\productModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class orderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyCustomer');
    }

    public function index()
    {
        $products = productModel::get();

        return view('order', ["productTable" => $products]);
    }

    public function product_buy()
    {
        $the_orders = DB::table('orders as O')
            ->select('O.*','P.name as product_name')
            ->join('products as P','P.id','O.product')
            ->get();

        return view('product_order', ["orderTable" => $the_orders]);
    }

    public function detail(Request $request)
    {

        if(!($request->has("id") && is_numeric($request->input("id"))))
            return "ERROR";

        $product_id = $request->input("id");

        $the_customer = productModel::where('id',$product_id)->first();

        return  "<b>ID :</b> ".$the_customer->id ."<br> <b>NAME:</b> ". $the_customer->name.
                "<br> <b>UNIT:</b> ". $the_customer->unit. "<br> <b>UNIT PRICE :</b> ". $the_customer->unit_price;


    }

    public function calculate(Request $request)
    {
        if(!($request->has("id") && is_numeric($request->input("id"))))
            return "ERROR";

        $order_id = $request->input("id");

        $the_order = orderModel::find($order_id);
        $the_product = orderModel::find($order_id)->getProduct;


        return "TOTAL : ".number_format($the_order->amount * $the_product->unit_price * 1.18,2);

    }

    public function buy(Request $request)
    {
        //@TODO check if product id and amount are numeric

        //@TODO validation

        $product_id = $request->input("id");
        $amount = $request->input("amount");
        $customer_id = Auth::user()->id;

        //save the order buy operation into db
        orderModel::create([
            'product'=>$product_id,
            'amount'=>$amount,
            'customer'=>$customer_id
        ]);

        return "success";
    }

}
