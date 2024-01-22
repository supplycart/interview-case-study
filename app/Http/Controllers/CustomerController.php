<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function list(){

        $customer_list = Customer::all();

        return view('customer.list', compact("customer_list"));
    }
}
