<?php

namespace App\Livewire\Admin\Reports;

ini_set('max_execution_time', 18000);

use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\OrderItem;
use App\Models\Orders;
use Carbon\Carbon;
use Livewire\Component;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class Sales extends Component
{
    public $sales;
    public $servicesSales;
    public $productsSales;
    public $weeklySales;
    public $dailySales;
    public $dailyVisits;
    public $startDate;
    public $endDate;
    
    public function render()
    {
        
        $transactions = Orders::latest()->paginate(10);

        $annual_sales = Orders::whereYear('created_at', Carbon::now()->year)->sum('total_amount');;

        $service_sales = OrderItem::where('item_type', 'service')->sum('price');

        $product_sales = OrderItem::where('item_type', 'product')->sum('price');

        // Get the current month's start and end dates
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the monthly revenue
        $monthly_sales = Orders::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->sum('total_amount');

        return view('livewire.admin.reports.sales', [
            'transactions' => $transactions,
            'total_sales' => $annual_sales,
            'monthly_sales' => $monthly_sales,
            'service_sales' => $service_sales,
            'product_sales' => $product_sales
        ]);
    }

    public function mount()
    {
        // Fetch and aggregate sales data by month
        $this->sales = Orders::selectRaw('SUM(total_amount) as total, DATE_FORMAT(created_at, "%Y-%m") as month')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();

        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $this->weeklySales = Orders::selectRaw('SUM(total_amount) as total, YEARWEEK(created_at, 1) as week')
                            ->groupBy('week')
                            ->orderBy('week')
                            ->pluck('total', 'week')
                            ->toArray();

        $this->dailySales = Orders::selectRaw('SUM(total_amount) as total, DATE(created_at) as day')
                            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                            ->groupBy('day')
                            ->orderBy('day')
                            ->pluck('total', 'day')
                            ->toArray();
        

         // Fetch sales data for services
         $this->servicesSales = OrderItem::where('item_type', 'Service')->sum('price');

         // Fetch sales data for products
         $this->productsSales = OrderItem::where('item_type', 'Product')->sum('price');

          // Fetch daily visit data
        $this->dailyVisits = Appointment::selectRaw('DATE(date) as visit_date, COUNT(*) as visit_count')
        ->groupBy('visit_date')
        ->get()
        ->pluck('visit_count', 'visit_date');

    }

    
    public function export()
    {
        // if (!empty($this->startDate) && !empty($this->endDate)) {
           
        // }

        $startDate = Carbon::parse($this->startDate)->startOfDay();
        $endDate = Carbon::parse($this->endDate)->endOfDay();

        $data = Orders::whereBetween('created_at', [$startDate, $endDate])->get();
        $totalSum = $data->sum('total_amount');
        $pdf = PDF::loadView('Admin.Dompdf.Sales.sales', ['data' => $data, 'total_amount' => $totalSum]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="sales_report_report.pdf"',
        ];

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'REPORTS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'EXPORTED SALES REPORT'
        ]);

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
