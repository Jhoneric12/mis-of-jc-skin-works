<?php

namespace App\Http\Controllers\Staff\Reports\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionReport extends Controller
{
    public function index()
    {
        return view('Staff.Reports.Transactions.transactions');
    }
}
