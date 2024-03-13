<?php

namespace App\Http\Controllers\Staff\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Transactions extends Controller
{
    public function index()
    {
        return view('Staff.Transactions.transactions');
    }
}
