<?php

namespace App\Livewire\Admin\Reports;

ini_set('max_execution_time', 18000);

use App\Models\AuditTrail;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class Products extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'Active';
    public $category = 'All';

    public function render()
    {
        $query = Product::query()
            ->where('product_name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc');

            if ($this->filter !== 'All') {
                $status = $this->filter === 'Active' ? 1 : 0;
                $query->where('status', $status);
            }
    
            if ($this->category !== 'All') {
                $query->where('product_category_id', $this->category);
            }

        $products = $query->paginate(10);

        return view('livewire.admin.reports.products', [
            'products' => $products,
            'categories' => ProductCategory::where('status', 1)->get()
        ]);
    }

    public function export()
    {
        $query = Product::query()
            ->where('product_name', 'like', '%' . $this->search . '%');

            if ($this->filter !== 'All') {
                $status = $this->filter === 'Active' ? 1 : 0;
                $query->where('status', $status);
            }
    
            if ($this->category !== 'All') {
                $query->where('product_category_id', $this->category);
            }

        $data = $query->latest()->get();

        $pdf = PDF::loadView('Admin.Dompdf.Products.products', ['data' => $data]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="products_list_report.pdf"',
        ];

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'REPORTS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'EXPORTED PRODUCTS REPORT'
        ]);

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
