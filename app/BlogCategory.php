<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
	protected $table = 'blog_categories';

	public function blogHasCategory()
	{
		return $this->hasMany('App\BlogHasCategory');
	}
}