<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagePatient extends Controller
{

    public function index() 
    {
        return view('Admin.Patient.manage-patient');
    }

    public function addPatient()
    {
        return view('Admin.Patient.add-patient');
    }

}
