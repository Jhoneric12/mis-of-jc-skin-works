<?php

namespace App\Http\Controllers\Staff\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Inventory extends Controller
{
    public function index()
    {
        return view('Staff.Inventory.inventory');
    }
}
