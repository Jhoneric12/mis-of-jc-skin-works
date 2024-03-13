<?php

namespace App\Http\Controllers\Admin\Settings\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ManageCategory extends Controller
{
    public function index ()
    {
        return view('Admin.Settings.Products.manage-category');
    }
}
