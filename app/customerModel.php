<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customerModel extends Model
{
    protected $table = 'customers';
    protected $fillable = ['id','name','officer_name','tel','fax','address'];

}
