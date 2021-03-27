<?php


namespace App\Helpers;


class CustomHelpers
{


    static function getActiveMenuName(){
        $request = app('request');
        return $request->segment(1);

    }
}