<?php

namespace App\Http\Controllers\Staff\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddMedicalRecord extends Controller
{
    public function index()
    {
        return view('Staff.Patient.add-medical-record');
    }
}
