<?php

namespace App\Livewire\Admin\Reports;

ini_set('max_execution_time', 18000);

use App\Models\AuditTrail;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Barryvdh\DomPDF\Facade\Pdf;

class InventoryReport extends Component
{
    public $search;

    public function render()
    {
        $query = Inventory::query()
            ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
            ->where('products.product_name', 'like', '%' . $this->search . '%')
            ->orWhere('inventories.product_id', $this->search)
            ->distinct()
            ->orderBy('inventories.created_at', 'desc');
            
        $products = $query->paginate(10);

        return view('livewire.admin.reports.inventory-report', [
            'products' => $products
        ]);
    }

    public function export()
    {
        $query = Inventory::query()
            ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
            ->where('products.product_name', 'like', '%' . $this->search . '%')
            ->orWhere('inventories.product_id', $this->search)
            ->distinct()
            ->orderBy('inventories.created_at', 'desc');
            
        $data = $query->get();
        
        $pdf = PDF::loadView('Admin.Dompdf.Inventory.inventory', ['data' => $data]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="inventory_list_report.pdf"',
        ];

        // Logs
        if(Auth::user()->role == 1)
        {
            AuditTrail::create([
                'user_id' => Auth::user()->id,
                'log_name' => 'INVENTORY',
                'user_type' => 'ADMINISTRATOR',
                'description' => 'EXPORTED INVENTORY'
            ]);
        }
        elseif(Auth::user()->role == 2)
        {
            AuditTrail::create([
                'user_id' => Auth::user()->id,
                'log_name' => 'INVENTORY',
                'user_type' => 'STAFF',
                'description' => 'EXPORTED INVENTORY'
            ]);
        }

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
