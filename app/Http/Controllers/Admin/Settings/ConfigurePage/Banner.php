<?php

namespace App\Http\Controllers\Admin\Settings\ConfigurePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Banner extends Controller
{
    public function index()
    {
        return view('Admin.Settings.ConfigurePage.banner');
    }
}
