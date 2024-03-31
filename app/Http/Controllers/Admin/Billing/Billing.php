<?php

namespace App\Http\Controllers\Admin\Billing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Billing extends Controller
{
    public function index()
    {
        return view('Admin.Billing.billing');
    }
}
