<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\CMSPage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    var $data;

    public function __construct() {

	    //$this->data['cmsPages'] = CMSPage::orderBy('id')->get();

	    $this->middleware(function ($request, $next) {
		    $cmsPages = CMSPage::orderBy('id')->get();

		    view()->share('cmsPages', $cmsPages);

		    return $next($request);
	    });
    }
}
