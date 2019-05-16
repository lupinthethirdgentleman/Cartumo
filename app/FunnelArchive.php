<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FunnelArchive extends Model
{
    public function funnel() {
        return $this->belongsTo('App\Funnel');
    }
}
