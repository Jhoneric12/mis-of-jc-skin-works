<?php

namespace App\Http\Controllers\Doctor\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentCalendar extends Controller
{
    public function index()
    {
        return view('Doctor.Appointments.appointment-calendar');
    }
}
