<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderModel extends Model
{
    protected $table = 'orders';
    protected $fillable = ['customer','product', 'amount'];

    public function getWithProductName(){
        return $this->belongsTo('App\productModel','product');
    }

    public function getProduct(){

        return $this->belongsTo('App\productModel','product');
    }


}
