<?php

namespace App\Livewire\Doctor\Prescription;

ini_set('max_execution_time', 18000);

use App\Models\AuditTrail;
use App\Models\Prescription;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

class GeneratePrescription extends Component
{
    public $patient_id;
    public $medication;
    public $description;
    public $patient_name;

    public function render()
    {
        return view('livewire.doctor.prescription.generate-prescription', [
            'patients' => User::where("role", 0)->whereNotnull('email_verified_at')->get()
        ]);
    }

    public function generate()
    {
        $this->validate([
            'patient_id' => 'required|exists:users,id',
            'medication' => 'required',
            'description' => 'required',
        ],['patient_id.exists' => 'Patient id not found']);

        Prescription::create([
            'patient_id' => $this->patient_id,
            'doctor_id' => Auth::user()->id,
            'medication' => strtoupper($this->medication),
            'description' => strtoupper($this->description),
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'PRESCRIPTION',
            'user_type' => 'DOCTOR',
            'description' => 'GENERATED PRESCRIPTION'
        ]);

        $this->reset();

       // Retrieve the most recent prescription
        $prescription = Prescription::with('patient')->latest()->first();

        $data = [
            'patient_name' => $prescription->patient->first_name . " " . $prescription->patient->middle_name . " " . $prescription->patient->last_name,
            'specialist_name' =>  $prescription->specialist->first_name . " " . $prescription->specialist->middle_name . " " . $prescription->specialist->last_name,
            'gender' => $prescription->patient->gender,
            'skin_type' => $prescription->patient->skin_type,
            'age' => $prescription->patient->age,
            'medication' => $prescription->medication,
            'description' => $prescription->description,
            'license_number' => $prescription->specialist->license_number
        ];

        $pdf = PDF::loadView('Admin.Dompdf.Prescription.prescription', ['data' => $data]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="prescription.pdf"',
        ];

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }

    public function searchPatient() 
    {
        $patient = User::where('id', $this->patient_id)->where('role', 0)->first();

        // Check if patient exists
        if (!$patient) {
            $this->addError('patient_id', 'No patient found.');
            return;
        }

        $this->patient_name =  $patient->first_name . " " . $patient->middle_name . " " .  $patient->last_name;
    }
}
