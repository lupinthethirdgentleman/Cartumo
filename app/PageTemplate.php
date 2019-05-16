<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\TemplateType;

class PageTemplate extends Model
{
    public function getCategory($id)
    {
        return TemplateType::find($id);
    }


    public function developer($id) {
        return $this->belongsTo('App\Developer');
    }
}
