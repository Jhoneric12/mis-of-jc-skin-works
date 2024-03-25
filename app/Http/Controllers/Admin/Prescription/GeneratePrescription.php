<?php

namespace App\Http\Controllers\Admin\Prescription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneratePrescription extends Controller
{
    public function index()
    {
        return view('Admin.Prescription.generate-prescription');
    }
}
