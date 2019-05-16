<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    public function order()
    {
    	return $this->belongsTo("App\Order");
    }
}
