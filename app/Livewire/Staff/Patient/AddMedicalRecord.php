<?php

namespace App\Livewire\Staff\Patient;

use App\Models\AuditTrail;
use Livewire\Component;
use App\Models\User;
use App\Models\MedicalRecord;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Session;

class AddMedicalRecord extends Component
{
    #[Url]
    public $patient_id;

    public $medication_allergies;
    public $findings;
    public $prescription;

    public function render()
    {
        return view('livewire.staff.patient.add-medical-record');
    }

    public function createRecord()
    {
        // $patient = User::where('id', $this->patient_id)->first();

        $this->validate([
            'medication_allergies' => 'required',
            'findings' => 'required',
            'prescription' => 'required'
        ]);

        MedicalRecord::create([
            'patient_id' => $this->patient_id,
            'medication_allergies' => strtoupper($this->medication_allergies),
            'findings' => strtoupper($this->findings),
            'prescription' => strtoupper($this->prescription),
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'MEDICAL RECORD',
            'user_type' => 'STAFF',
            'description' => 'ADDED MEDICAL RECORD'
        ]);

        Session::flash('created', 'Added Successfully.');

        $this->redirectRoute('staff-view-profile', ['patient_id' => $this->patient_id]);
    }
}
