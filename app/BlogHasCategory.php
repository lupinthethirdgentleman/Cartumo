<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogHasCategory extends Model
{
	protected $table = 'blog_has_categories';
	public $timestamps = false;
}