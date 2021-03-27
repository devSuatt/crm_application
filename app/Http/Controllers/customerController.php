<?php

namespace App\Http\Controllers;

use App\customerModel;
use App\orderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class customerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyAdmin');
    }

    public function index()
    {
        $customers = customerModel::get();

        return view('customer',["customerTable"=>$customers]);
    }

    public function add(Request $request) {

        $request->validate([
            'id' => 'required|unique:products',
            'name' => 'required|min:2',
            'officer_name'=>'required',
            'tel'=>'required',
            'fax'=>'required',
            'address'=>'required'
        ]);

        customerModel::create($request->all());

        return redirect()->back()->with('success', 'Yeni müşteri başarıyla eklendi');
    }

    public function customer_order()
    {

        $the_orders = DB::table('orders as O')
            ->select('O.*','P.name as product_name','U.name as customer_name')
            ->join('products as P','P.id','O.product')
            ->join('users as U','U.id','O.customer')
            ->get();

        return view('customer_orders', ["orderTable" => $the_orders]);

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


    public function delete(Request $request){

        if(!($request->has("id") && is_numeric($request->input("id"))))
            return "ERROR";

        $customer_id = $request->input("id");

        //delete from db
        customerModel::where('id',$customer_id)->delete();

        return "SUCCESS";
    }

    public function detail(Request $request){

        if(!($request->has("id") && is_numeric($request->input("id"))))
            return "ERROR";

        $customer_id = $request->input("id");

        $the_customer = customerModel::where('id',$customer_id)->first();

        return json_encode($the_customer);

    }

    public function fetchData(Request $request)
    {

        if(!($request->has("id") && is_numeric($request->input("id"))))
            return "ERROR";

        $customer_id = $request->input("id");

        $the_customer = customerModel::where('id',$customer_id)->first();
        return json_encode($the_customer);
    }

    public function update(Request $request){


        //@TODO input validation

        $id = $request->input("id");
        $name = $request->input("name");
        $officer_name = $request->input("officer_name");
        $tel = $request->input("tel");
        $fax = $request->input("fax");
        $address = $request->input("address");


        //@TODO check if customers table has a row for given customer

        customerModel::where("id",$id)->update([
            'name' => $name,
            'officer_name'=> $officer_name,
            'tel' => $tel,
            'fax' => $fax,
            'address' => $address

        ]);

        return redirect()->back()->with('success', 'Customer data changed successfully!');
    }

}
