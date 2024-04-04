<?php

namespace App\Http\Controllers\Staff\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageAppointments extends Controller
{
    public function index() 
    {
        return view('Staff.Appointments.appointment-calendar');
    }
}
