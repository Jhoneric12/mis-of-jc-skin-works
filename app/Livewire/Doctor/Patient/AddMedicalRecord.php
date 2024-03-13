<?php

namespace App\Livewire\Doctor\Patient;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\MedicalRecord;
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

        return view('livewire.doctor.patient.add-medical-record');
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

        Session::flash('created', 'Added Successfully.');

        $this->redirectRoute('doctor-view-profile', ['patient_id' => $this->patient_id]);
    }
}
