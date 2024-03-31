<?php

namespace App\Http\Controllers\Doctor\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageAppointments extends Controller
{
    public function index()
    {
        return view('Doctor.Appointments.manage-appointments');
    }
}
