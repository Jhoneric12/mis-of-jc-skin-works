<?php

namespace App\Http\Controllers\Doctor\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewMedicalRecord extends Controller
{
    public function index()
    {
        return view('Doctor.Patient.view-medical-record');
    }
}
