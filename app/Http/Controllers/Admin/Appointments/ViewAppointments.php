<?php

namespace App\Http\Controllers\Admin\Appointments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewAppointments extends Controller
{
    public function index()
    {
        return view('Admin.Appointments.view-appointments');
    }
}
