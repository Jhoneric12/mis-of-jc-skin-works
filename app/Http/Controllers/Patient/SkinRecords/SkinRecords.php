<?php

namespace App\Http\Controllers\Patient\SkinRecords;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SkinRecords extends Controller
{
    public function index()
    {
        return view('Patient.SkinRecords.skin-records');
    }
}
