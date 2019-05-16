<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
	// //////////////////////////////////////////////
    // Member Functions
    // //////////////////////////////////////////////


    
	// //////////////////////////////////////////////
    // Relations
    // //////////////////////////////////////////////

    public function steps()
    {
    	return $this->hasMany("App\FunnelStep");
    }


    public function paymentGateway() {
        return $this->hasOne("App\UserPaymentGateway");
    }

    public function user() {
        return $this->belongsTo("App\User");
    }
}
