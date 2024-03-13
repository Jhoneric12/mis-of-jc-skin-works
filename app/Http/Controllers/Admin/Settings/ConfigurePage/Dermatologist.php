<?php

namespace App\Http\Controllers\Admin\Settings\ConfigurePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dermatologist extends Controller
{
    public function index()
    {
        return view('Admin.Settings.ConfigurePage.dermatologist');
    }
}
