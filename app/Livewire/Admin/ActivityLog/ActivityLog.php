<?php

namespace App\Livewire\Admin\ActivityLog;

ini_set('max_execution_time', 18000);

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\AuditTrail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLog extends Component
{
    use WithPagination;

    public $search = '';
    public $startDate = '';
    public $endDate = '';

    public function render()
    {
        $query = AuditTrail::query()
            ->where(function ($query) {
                $query->where('user_id',  $this->search)
                      ->orWhere('user_type', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when(!empty($this->startDate) && !empty($this->endDate), function ($query) {
                $startDate = Carbon::parse($this->startDate)->startOfDay();
                $endDate = Carbon::parse($this->endDate)->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->latest();
    
        $auditTrailRecords = $query->paginate(10);
    
        return view('livewire.admin.activity-log.activity-log', [
            'logs' => $auditTrailRecords
        ]);
    }

    public function filterByDate()
    {
        $this->resetPage();
    }

    public function export()
    {
        $query = AuditTrail::query()
            ->where(function ($query) {
                $query->where('user_id',  $this->search)
                      ->orWhere('user_type', $this->search)
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when(!empty($this->startDate) && !empty($this->endDate), function ($query) {
                $startDate = Carbon::parse($this->startDate)->startOfDay();
                $endDate = Carbon::parse($this->endDate)->endOfDay();
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->latest();
    
        $data = $query->get();
        
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
