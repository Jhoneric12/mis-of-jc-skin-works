<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdatePatient extends Controller
{
    public function index()
    {
        return view('Admin.Patient.update-patient');
    }
}
