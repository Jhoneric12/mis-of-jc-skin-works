<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Transactions extends Controller
{
    public function index()
    {
        return view('Admin.Transactions.Transactions');
    }
}
