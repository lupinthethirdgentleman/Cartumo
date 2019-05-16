<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function payment()
    {
    	return $this->hasOne("App\ProductPayment");
    }

    public function options()
    {
    	return $this->hasMany("App\ProductOption");
    }
}
