<?php

namespace App\Http\Controllers\Admin\Settings\BackUp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackUpDatabase extends Controller
{
    public function index()
    {
        return view('Admin.Settings.BackUp.backup-database');
    }
}
