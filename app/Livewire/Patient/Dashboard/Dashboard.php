<?php

namespace App\Livewire\Patient\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Appointment;

class Dashboard extends Component
{
    public $patientName;

    public function render()
    {
        $this->patientName = Auth::user()->first_name . " " . Auth::user()->last_name;

        // Retrieve the start and end dates for the current month
        // $currentMonthStart = Carbon::now()->startOfMonth();
        // $currentMonthEnd = Carbon::now()->endOfMonth();

        // Retrieve appointments with status 'Confirmed' within the current month
        $appointments = Appointment::where('patient_id', Auth::user()->id)
            ->whereIn('status', ['Confirmed', 'Cancelled', 'Completed', 'Scheduled'])
            ->whereDate('date', '=',  Carbon::today()->toDateString())
            ->latest()
            ->paginate(5);

        return view('livewire.patient.dashboard.dashboard', ['appointments' => $appointments]);
    }
}
