<?php

namespace App\Http\Controllers\Staff\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentCalendar extends Controller
{
    public function index()
    {
        return view('Staff.Appointments.manage-appointments');
    }
}
