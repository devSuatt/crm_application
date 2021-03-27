<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewRequest;
use App\productModel;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('onlyAdmin');
    }

    public function index()
    {
        $products = productModel::get();

        return view('product', ["productTable" => $products]);
    }

    public function add(Request $request)
    {

        $request->validate([
            'id' => 'required|unique:products',
            'name' => 'required|min:2',
            'unit_price'=>'required|numeric',
            'unit'=>'required'
        ]);

        productModel::create($request->all());

        return redirect()->back()->with('success', 'Yeni ürün başarıyla eklendi');
    }

    public function fetchData(Request $request)
    {

        if(!($request->has("id") && is_numeric($request->input("id"))))
            return "ERROR";

        $product_id = $request->input("id");

        $the_product = productModel::where('id',$product_id)->first();
        return json_encode($the_product);
    }

    public function update(Request $request){


        //@TODO input validation

        $id = $request->input("id");
        $name = $request->input("name");
        $unit = $request->input("unit");
        $unit_price = $request->input("unit_price");


        //@TODO check if products table has a row for given product

        productModel::where("id",$id)->update([
            'name' => $name,
            'unit' => $unit,
            'unit_price'=>$unit_price
        ]);

        return redirect()->back()->with('success', 'Product feature changed successfully!');
    }

    public function delete(Request $request)
    {

        if(!($request->has("id") && is_numeric($request->input("id"))))
            return "ERROR";

        $product_id = $request->input("id");

        //delete from db
        productModel::where('id',$product_id)->delete();

        return "SUCCESS";
    }

    public function detail(Request $request)
    {

        if(!($request->has("id") && is_numeric($request->input("id"))))
            return "ERROR";

        $product_id = $request->input("id");

        $the_customer = productModel::where('id',$product_id)->first();

        return json_encode($the_customer);

    }

}
