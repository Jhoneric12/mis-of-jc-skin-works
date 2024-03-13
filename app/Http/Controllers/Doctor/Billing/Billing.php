<?php

namespace App\Http\Controllers\Doctor\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Billing extends Controller
{
    public function index()
    {
        return view('Doctor.Billing.billing');
    }
}
