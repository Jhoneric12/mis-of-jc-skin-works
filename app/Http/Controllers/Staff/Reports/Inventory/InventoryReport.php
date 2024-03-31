<?php

namespace App\Http\Controllers\Staff\Reports\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InventoryReport extends Controller
{
    public function index()
    {
        return view('Staff.Reports.Inventory.inventory-report');
    }
}
