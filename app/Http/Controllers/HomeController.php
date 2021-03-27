<?php

namespace App\Http\Controllers;

use App\User;
use App\userModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome');
    }

    public function fetch_data () {


        $result = DB::table('orders as o')
            ->select(
                DB::raw('COUNT(*) as count'),
                'u.id',
                'u.email as email',
                DB::raw('SUM(o.amount) as total_amount'),
                DB::raw('SUM(o.amount*p.unit_price) as total_price')
            //DB::raw('SUM()')
            )
            ->leftJoin('users as u','u.id','o.customer')
            ->leftJoin('products as p','p.id','o.product')
            ->groupBy('u.id','u.email')
            ->distinct()
            ->get();

        $return_array = [];

        foreach ($result as $one_result){
            $return_array["order_count"][] = array("name"=>$one_result->email,"y"=>(int)$one_result->count);
            $return_array["order_amount"][] = array("name"=>$one_result->email,"y"=>(int)$one_result->total_amount);
            $return_array["order_price"][] = array("name"=>$one_result->email,"y"=>(int)$one_result->total_price);
        }


        $return_array = json_encode($return_array);

        return $return_array;

    }

    public function fetch_product_rate () {

        $result = DB::table('orders as o')
            ->select(
                DB::raw('COUNT(*) as count'),
                'p.id',
                'p.name as name'
            )

            ->leftJoin('products as p','p.id','o.product')
            ->groupBy('p.id','p.name')
            ->distinct()
            ->get();

        $return_array = [];

        foreach ($result as $one_result){
            $return_array["product_count"][] = array("name"=>$one_result->name,"y"=>(int)$one_result->count);

        }


        $return_array = json_encode($return_array);

        return $return_array;

    }



}
