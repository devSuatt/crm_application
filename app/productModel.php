<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class productModel extends Model
{
    protected $table = 'products';
    protected $fillable = ['id','name','unit','unit_price'];

}
