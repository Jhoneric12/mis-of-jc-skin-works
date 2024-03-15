<?php

namespace App\Http\Controllers\Admin\Settings\Promotions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagePromotions extends Controller
{
    public function index()
    {
        return view('Admin.Settings.Promotions.promotions');
    }
}
