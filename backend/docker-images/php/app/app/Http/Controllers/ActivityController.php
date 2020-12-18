<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct(Request $request)
    {
	    parent::__construct($request);
    }
}
