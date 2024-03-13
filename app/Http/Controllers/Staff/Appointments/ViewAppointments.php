<?php

namespace App\Http\Controllers\Staff\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewAppointments extends Controller
{
    public function index()
    {
        return view('Staff.Appointments.view-appointments');
    }
}
