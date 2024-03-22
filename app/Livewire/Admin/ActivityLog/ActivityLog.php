<?php

namespace App\Livewire\Admin\ActivityLog;

ini_set('max_execution_time', 18000);

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\AuditTrail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ActivityLog extends Component
{
    public function render()
    {
        $logs = AuditTrail::orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.admin.activity-log.activity-log', [
            'logs' => $logs
        ]);
    }

    public function export()
    {
        $data = AuditTrail::latest()->get();
        $pdf = PDF::loadView('Admin.Dompdf.ActivityLog.activity-log', ['data' => $data]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="activity_list_report.pdf"',
        ];

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'ACTIVITY LOG',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'EXPORTED ACTIVITY LOG'
        ]);

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
