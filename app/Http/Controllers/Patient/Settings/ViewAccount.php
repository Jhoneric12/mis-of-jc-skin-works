<?php

namespace App\Http\Controllers\Patient\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewAccount extends Controller
{
    public function index()
    {
        return view('Patient.Settings.view-account');
    }
}
