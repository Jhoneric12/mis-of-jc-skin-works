<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Inventory extends Controller
{
    public function index()
    {
        return view('Admin.Reports.inventory');
    }
}
