<?php

namespace App\Http\Controllers\Admin\Settings\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class ManageProducts extends Controller
{
    public function index() 
    {
        return view('Admin.Settings.Products.manage-products');
    }
}
