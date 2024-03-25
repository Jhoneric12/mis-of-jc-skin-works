<?php

namespace App\Livewire\Admin\Inventory;

ini_set('max_execution_time', 18000);

use App\Models\AuditTrail;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Inventory;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

class ManageInventory extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $search = '';
    public $filter = 'Active';
    public $category = 'All';

    public $product_id;
    public $product_name;
    public $product_category;
    public $quantity;
    public $price;
    public $exp_date;
    public $total_quantity;

    public function render()
    {
        $query = Inventory::query()
            ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
            ->where('products.product_name', 'like', '%' . $this->search . '%')
            ->orWhere('inventories.product_id', $this->search)
            ->distinct()
            ->orderBy('inventories.created_at', 'desc');
            
        $products = $query->paginate(10);

        return view('livewire.admin.inventory.manage-inventory', [
            'products' => $products,
            'categories' => ProductCategory::all(),
            'items' => Product::all(),

        ]);
    }

    public function openModal()
    {
        $this->modalAdd = true;
    }

    public function closeModal()
    {
        $this->modalAdd = false;
        $this->modalUpdate = false;
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate([
            'product_id' => 'required',
            'total_quantity' => 'required',
            'exp_date' => 'required',
        ]);

       // Find existing inventory for the product
        $inventory = Inventory::where('product_id', $this->product_id)->first();

        if ($inventory) {
            // If inventory exists, update the total quantity in the product model
            $product = Product::find($this->product_id);
            if ($product) {
                $product->total_qty += $this->total_quantity;
                $product->save();
            }
        } else {
            // If inventory doesn't exist, create a new entry
            Inventory::create([
                'product_id' => $this->product_id,
                'total_quantity' => $this->total_quantity,
                'expiration_date' => $this->exp_date,
            ]);
        }

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'INVENTORY',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'ADDED STOCKS'
        ]);

        $this->resetFields();
        $this->dispatch('created');
    }

    public function export()
    {
        $data = Inventory::latest()->get();
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

    // public function view($id)
    // {
    //     $this->modalView = true;

    //     $this->product_id = $id;

    //     $product_id = Inventory::where('id', $id)->first();

    //     $this->product_name = $product_id->product->product_name; 

        

    // }
}
