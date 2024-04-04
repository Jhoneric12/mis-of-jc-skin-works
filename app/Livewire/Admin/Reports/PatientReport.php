<?php

namespace App\Livewire\Admin\Reports;

ini_set('max_execution_time', 18000);

use App\Models\AuditTrail;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PatientReport extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $patients = User::where('role', '0')
            ->where(function ($query) {
                $query->where('username', 'like', '%' . $this->search . '%')
                      ->orWhere('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('id', $this->search);
                    //   ->orWhereNotNull('gender');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.reports.patient-report', [
            'patients' => $patients
        ]);
    }

    public function export()
    {
        $data = User::where('role', '0')
            ->where(function ($query) {
                $query->where('username', 'like', '%' . $this->search . '%')
                      ->orWhere('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('id', $this->search);
                    //   ->orWhereNotNull('gender');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = PDF::loadView('Admin.Dompdf.Patient.patient-report', ['data' => $data]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="patient_list_report.pdf"',
        ];

        if (Auth::user()->role == 1)
        {
            // Logs
            AuditTrail::create([
                'user_id' => Auth::user()->id,
                'log_name' => 'REPORTS',
                'user_type' => 'ADMINISTRATOR',
                'description' => 'EXPORTED PATIENT'
            ]);
        }
        elseif (Auth::user()->role == 2)
        {
            // Logs
            AuditTrail::create([
                'user_id' => Auth::user()->id,
                'log_name' => 'REPORTS',
                'user_type' => 'STAFF',
                'description' => 'EXPORTED PATIENT'
            ]);
        }
        elseif (Auth::user()->role == 3)
        {
            // Logs
            AuditTrail::create([
                'user_id' => Auth::user()->id,
                'log_name' => 'REPORTS',
                'user_type' => 'DOCTOR',
                'description' => 'EXPORTED PATIENT'
            ]);
        }

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
