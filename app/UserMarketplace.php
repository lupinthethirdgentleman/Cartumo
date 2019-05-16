<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMarketplace extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function funnel() {
        return $this->belongsTo('App\Funnel');
    }
}
