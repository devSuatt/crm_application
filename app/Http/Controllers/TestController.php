<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class TestController extends Controller
{
    public function get_test() {
        $myName = Input::get('isim');
        $mySurname = Input::get('soyisim');
        return view('test')->with('name',$myName)->with('surname',$mySurname);
    }

    public function get_customers() {
        $myName = Input::get('isim');
        $mySurname = Input::get('soyisim');
        return view('internals.customers')->with('name',$myName)->with('surname',$mySurname);
    }

    public function get_categories($forum,$php,$laravel) {
        return view('myProfile')->with('myForum',$forum)->with('myPhp',$php)->with('myLaravel',$laravel);
    }

    public function test_name($name) {

        return view('test')->with('name',$name);
    }

    public function  get_form() {
        return view('form');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function  post_form(Request $request) {
        $first = $request->first;
        $second = $request->second;
        $sum = $second + $first;
        return view('form') -> with('sum',$sum);
    }

}
