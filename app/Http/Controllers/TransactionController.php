<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function list(){
        $transaction_list = Transaction::all();

        return view('transaction.list', compact('transaction_list'));
    }
}
