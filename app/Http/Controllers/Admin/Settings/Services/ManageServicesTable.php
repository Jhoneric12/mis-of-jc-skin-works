<?php

namespace App\Http\Controllers\Admin\Settings\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageServicesTable extends Controller
{
    public function index()
    {
        return view('Admin.Settings.Services.manage-services-table');
    }
}
