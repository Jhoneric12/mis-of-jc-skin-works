<?php

namespace App\Http\Controllers\Admin\Settings\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Doctors extends Controller
{
    public function index()
    {
        return view('Admin.Settings.Accounts.doctors');
    }
}
