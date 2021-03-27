<?php

namespace App\Http\Controllers;

use App\testModel;
use PhpMyAdmin\Server\Status\Data;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_user() {
        $user_f = testModel::all();
        return view('user')->with('user_features',$user_f);
    }

    public function post_user(Request $request) {   //DB'de veri üretmek için kullanılan fonksiyon
        //testModel::create($request->all());
        //print_r($request->post());

        $request->validate([
            'name' => 'required | min:3',
            'email' => 'required | email',
        ]);

        return 'Successful Process';
    }



}
