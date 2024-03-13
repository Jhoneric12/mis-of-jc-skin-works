<?php

namespace App\Http\Controllers\Doctor\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddAppointments extends Controller
{
    public function index()
    {
        return view('Doctor.Appointments.add-appointment');
    }
}
