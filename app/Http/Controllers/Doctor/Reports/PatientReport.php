<?php

namespace App\Http\Controllers\Doctor\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientReport extends Controller
{
    public function index()
    {
        return view('Doctor.Reports.patient-report');
    }
}
