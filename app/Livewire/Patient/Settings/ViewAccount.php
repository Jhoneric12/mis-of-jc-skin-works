<?php

namespace App\Livewire\Patient\Settings;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewAccount extends Component
{
    public function render()
    {
        $patients = User::where('id', Auth::user()->id)->first();

        $patient = User::where('id', Auth::user()->id)->first();

        $records = MedicalRecord::where('patient_id', Auth::user()->id)->paginate(5);

        $sessions = Appointment::where('patient_id', Auth::user()->id)->latest()->get();

        return view('livewire.patient.settings.view-account', [
            'patient' => $patients,
            'patient' => $patient,
            'records' => $records,
            'sessions' => $sessions
        ]);
    }
}
