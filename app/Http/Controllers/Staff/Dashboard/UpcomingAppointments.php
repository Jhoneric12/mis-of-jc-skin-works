<?php

namespace App\Http\Controllers\Staff\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class UpcomingAppointments extends Controller
{
    public function upcomingAppointments()
    {
        $userId = Auth::user()->id;

        $appointments = Appointment::where('specialist_id', $userId)
                                    ->whereDate('created_at', '>=', now()->toDateString())
                                    ->latest()
                                    ->paginate(5);

        return view('Staff.dashboard', ['appointments' => $appointments]);
    }
}
