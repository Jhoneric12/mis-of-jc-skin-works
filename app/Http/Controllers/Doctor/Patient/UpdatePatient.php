<?php

namespace App\Http\Controllers\Doctor\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdatePatient extends Controller
{
    public function index()
    {
        return view('Doctor.Patient.update-patient');
    }
}
