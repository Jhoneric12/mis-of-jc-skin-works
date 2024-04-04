<?php

namespace App\Livewire\Doctor\Patient;

ini_set('max_execution_time', 18000);

use Livewire\Component;
use App\Models\MedicalRecord;
use Livewire\Attributes\Url;
use Barryvdh\DomPDF\Facade\Pdf;

class ViewMedicalRecord extends Component
{
    #[URL]
    public $record_id;

    public $medication_allergies;
    public $findings;
    public $prescription;
    public $fullname;
    public $email;
    public $contact_number;
    public $skintype;
    public $home_address;

    public function render()
    {
        $record = MedicalRecord::where('id', $this->record_id)->first();

        $this->fullname = $record->patient->first_name . " " . $record->patient->middle_name . " " . $record->patient->last_name;
        $this->email = $record->patient->email;
        $this->contact_number = $record->patient->contact_number;
        $this->home_address = $record->patient->home_address;
        $this->skintype = $record->patient->skin_type;
        $this->findings = $record->findings;
        $this->medication_allergies = $record->medication_allergies;
        $this->prescription = $record->prescription;

        return view('livewire.doctor.patient.view-medical-record');
    }

    public function export()
    {
        $medicalRecord = MedicalRecord::with('patient')->find($this->record_id);

        $data = [
            'fullname' => $medicalRecord->patient->first_name . " " . $medicalRecord->patient->middle_name . " " . $medicalRecord->patient->last_name,
            'contact_number' => $medicalRecord->patient->contact_number,
            'email' => $medicalRecord->patient->email,
            'home_address' => $medicalRecord->patient->home_address,
            'skintype' => $medicalRecord->patient->skin_type,
            'medication_allergies' => $medicalRecord->medication_allergies,
            'findings' => $medicalRecord->findings,
            'prescription' => $medicalRecord->prescription,
        ];

        $pdf = PDF::loadView('Admin.Dompdf.Patient.medical-record', ['data' => $data]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="medical_record.pdf"',
        ];

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
