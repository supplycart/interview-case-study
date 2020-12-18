<?php

namespace App\Http\Controllers;

use App\Libraries\Common;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
	public function __construct(Request $request)
	{
		Common::logActivities($request);
	}
}
