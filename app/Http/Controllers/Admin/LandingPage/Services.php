<?php

namespace App\Http\Controllers\Admin\LandingPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Services extends Controller
{
    public function index()
    {
        return view('Admin.LandingPage.services');
    }
}
