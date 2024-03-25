<?php

namespace App\Livewire\Staff\Reports\Transactions;

ini_set('max_execution_time', 18000);

use App\Models\AuditTrail;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionReport extends Component
{
    use WithPagination;

    public $search = '';
    public $startDate = '';
    public $endDate = '';
    public $payment_mode = 'All';

    public function render()
    {
        $query = Orders::query()
        ->where('staff_id', Auth::user()->id)
        ->where(function ($query) {
            $query->where('patient_id', $this->search)
                  ->orWhere('patient_name', 'like', '%' . $this->search . '%');
        })

        ->when($this->payment_mode !== 'All', function ($query) {
            $query->where('payment_mode', $this->payment_mode);
        })

        ->latest();

        if (!empty($this->startDate) && !empty($this->endDate)) {
            $startDate = Carbon::parse($this->startDate)->startOfDay();
            $endDate = Carbon::parse($this->endDate)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $transactions = $query->paginate(10);

        return view('livewire.staff.reports.transactions.transaction-report', [
            'transactions' => $transactions
        ]);
    }

    public function filterByDate()
    {
        $this->resetPage();
    }

    public function export()
    {
        $query = Orders::query()
        ->where('staff_id', Auth::user()->id)
        ->where(function ($query) {
            $query->where('patient_id', $this->search)
                  ->orWhere('patient_name', 'like', '%' . $this->search . '%');
        })

        ->when($this->payment_mode !== 'All', function ($query) {
            $query->where('payment_mode', $this->payment_mode);
        })

        ->latest();

        if (!empty($this->startDate) && !empty($this->endDate)) {
            $startDate = Carbon::parse($this->startDate)->startOfDay();
            $endDate = Carbon::parse($this->endDate)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $data = $query->get();

        $totalAmount = $data->sum('total_amount');

        $pdf = PDF::loadView('Admin.Dompdf.Transaction.transaction', ['data' => $data, 'total_amount' => $totalAmount]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="transaction_list_report.pdf"',
        ];

        if (Auth::user()->role == 2)
        {
            // Logs
            AuditTrail::create([
                'user_id' => Auth::user()->id,
                'log_name' => 'REPORT',
                'user_type' => 'STAFF',
                'description' => 'EXPORTED TRANSACTION'
            ]);
        }
        elseif (Auth::user()->role == 3)
        {
            // Logs
            AuditTrail::create([
                'user_id' => Auth::user()->id,
                'log_name' => 'REPORT',
                'user_type' => 'DOCTOR',
                'description' => 'EXPORTED TRANSACTION'
            ]);
        }

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
