<?php

namespace App\Http\Controllers\Admin\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageAppointments extends Controller
{
    public function index()
    {
        return view('Admin.Appointments.manage-appointments');
    }
}
