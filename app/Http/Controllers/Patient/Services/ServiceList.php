<?php

namespace App\Http\Controllers\Patient\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceList extends Controller
{
    public function index()
    {
        return view('Patient.Services.service-list');
    }
}
