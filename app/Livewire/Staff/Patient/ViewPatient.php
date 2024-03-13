<?php

namespace App\Livewire\Staff\Patient;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\User;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;

class ViewPatient extends Component
{
    #[URL]
    public $patient_id;

    public $appointment_id;

    public function render()
    {
        $patient = User::where('id', $this->patient_id)->first();

        $sessions = Appointment::where('patient_id', $this->patient_id)->where('specialist_id', Auth::user()->id)->get();

        $records = MedicalRecord::where('patient_id', $this->patient_id)->paginate(3);

        return view('livewire.staff.patient.view-patient', ['patient' => $patient, 'sessions' => $sessions, 'records' => $records]);
    }  
}
