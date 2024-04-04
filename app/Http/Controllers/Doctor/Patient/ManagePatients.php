<?php

namespace App\Http\Controllers\Doctor\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagePatients extends Controller
{
    public function index()
    {
        return view('Doctor.Patient.manage-patients');
    }
}
