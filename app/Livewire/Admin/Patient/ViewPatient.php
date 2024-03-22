<?php

namespace App\Livewire\Admin\Patient;

use Livewire\Component;
use App\Models\User;
use App\Models\Appointment;
use App\Models\AppointmentSession;
use Livewire\Attributes\Url;
use App\Models\MedicalRecord;

class ViewPatient extends Component
{
    #[URL]
    public $patient_id;

    public $appointment_id;

    public function render()
    {
        $patient = User::where('id', $this->patient_id)->first();

        $sessions = Appointment::where('patient_id', $this->patient_id)->latest()->get();

        $records = MedicalRecord::where('patient_id', $this->patient_id)->paginate(3);

        return view('livewire.admin.patient.view-patient', ['patient' => $patient, 'sessions' => $sessions, 'records' => $records]);
    }  
}
