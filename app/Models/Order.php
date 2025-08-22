<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
 use HasFactory;

    public function nameUser(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function productName(){
        return $this->hasOne('App\Models\prducts','id','product_id');
    }
    protected $table = 'orders';
    protected $guarded = [];

}
