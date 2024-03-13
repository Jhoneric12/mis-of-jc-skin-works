<?php

namespace App\Http\Controllers\Staff\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagePatient extends Controller
{
    public function index() 
    {
        return view('Staff.Patient.manage-patient');
    }
}
