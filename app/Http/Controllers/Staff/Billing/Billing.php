<?php

namespace App\Http\Controllers\Staff\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Billing extends Controller
{
    public function index()
    {
        return view('Staff.Billing.billing');
    }
}
