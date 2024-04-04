<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\ClinicNotif;

class AuthController extends Controller
{
    public function index () 
    {
        $users = Auth::user()->role;

        if ($users == 0) 
        {
            return view('Patient.dashboard');
        }
        else if ($users == 1)
        {
            return view('Admin.dashboard');

        }
        else if ($users == 2)
        {
            $appointments = Appointment::whereDate('created_at', now()->toDateString())->paginate(5);

            return view('Staff.dashboard', ['appointments' => $appointments]);
        }
        else if ($users == 3)
        {
            return view('Doctor.dashboard');
        }
    }

    public function AdminDashboard()
    {
        return view('Admin.dashboard');
    }

    public function PatientDashboard()
    {
        return view('Patient.dashboard');
    }

    public function StaffDashboard()
    {
        return view('Staff.dashboard');
    }
}
