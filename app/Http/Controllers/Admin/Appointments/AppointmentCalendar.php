<?php

namespace App\Http\Controllers\Admin\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentCalendar extends Controller
{
    public function index()
    {
        return view('Admin.Appointments.appointment-calendar');
    }
}
