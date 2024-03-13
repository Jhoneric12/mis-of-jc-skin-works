<?php

namespace App\Http\Controllers\Patient\MyAppointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddAppointments extends Controller
{
    public function index()
    {
        return view('Patient.MyAppointments.add-appointments');
    }
}
