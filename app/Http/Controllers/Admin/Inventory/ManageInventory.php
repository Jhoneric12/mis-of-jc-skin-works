<?php

namespace App\Http\Controllers\Admin\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageInventory extends Controller
{
    public function index()
    {
        return view('Admin.Inventory.manage-inventory');
    }
}
