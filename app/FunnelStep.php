<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FunnelStep extends Model
{
    // //////////////////////////////////////////////
    // Member Functions
    // //////////////////////////////////////////////

    // Set the price etc. of product
    public function setContent($content = "")
    {
        /*$content = str_ireplace("{[title]}",  $this->product->title, $content);
        $content = str_ireplace("{[vendor]}", $this->product->vendor, $content);
        $content = str_ireplace("{[image]}",  $this->product->image, $content);
        $content = str_ireplace("{[price]}",  $this->product->price, $content);
        $content = str_ireplace("{[quantity]}", $this->product->quantity, $content);*/

        return $content;
    }





    // //////////////////////////////////////////////
    // Relations
    // //////////////////////////////////////////////

	public function page()
	{
		return $this->hasOne("App\Page");
	}

    public function funnel()
    {
        return $this->belongsTo("App\Funnel");
    }
	
    public function templates()
    {
    	return $this->hasMany("App\PageTemplate", "type", "type");
    }

    public function product()
    {
    	return $this->hasOne("App\Product");
    }

    public function stepProduct()
    {
    	return $this->hasOne("App\StepProduct");
    }


    public function type()
    {
        return $this->hasOne("App\FunnelType");
    }
}
