<?php

namespace App\Http\Controllers\Doctor\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Transactions extends Controller
{
    public function index()
    {
        return view('Doctor.Transactions.transactions');
    }
}
