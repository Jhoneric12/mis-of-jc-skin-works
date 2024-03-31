<?php

namespace App\Http\Controllers\Doctor\Prescription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneratePrescription extends Controller
{
    public function index()
    {
        return view('Doctor.Prescription.generate-prescription');
    }
}
