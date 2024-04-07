<?php

namespace App\Livewire\Patient\SkinRecords;

use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SkinRecords extends Component
{
    public function render()
    {
        $patients = User::where('id', Auth::user()->id)->first();

        $records = MedicalRecord::where('patient_id', Auth::user()->id)->paginate(5);

        $sessions = Appointment::where('patient_id', Auth::user()->id)->latest()->get();

        return view('livewire.patient.skin-records.skin-records', [
            'patients' => $patients,
            'records' => $records,
            'sessions' => $sessions
        ]);
    }
}
