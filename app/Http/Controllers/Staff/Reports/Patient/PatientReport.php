<?php

namespace App\Http\Controllers\Staff\Reports\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientReport extends Controller
{
    public function index()
    {
        return view('Staff.Reports.Patient.patient-report');
    }
}
