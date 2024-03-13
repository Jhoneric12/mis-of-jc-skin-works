<?php

namespace App\Http\Controllers\Patient\MyAppointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Appointments extends Controller
{
    public function index()
    {
        return view('Patient.MyAppointments.appointments');
    }
}
