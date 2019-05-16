<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderDetails()
    {
    	return $this->hasOne("App\OrderDetail");
    }

    public function orderProduct()
    {
    	return $this->hasOne("App\OrderProducts");
    }
}
