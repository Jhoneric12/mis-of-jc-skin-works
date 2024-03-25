<?php

namespace App\Livewire\Admin\Settings\Products;

ini_set('max_execution_time', 18000);

use App\Models\AuditTrail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\ProductCategory;
use Livewire\WithFileUploads;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ManageProducts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $modalImage = false;
    public $search = '';
    public $filter = 'Active';
    public $category = 'All';

    public $product_name;
    public $product_id;
    public $product_category_id;
    public $description;
    public $min_qty;
    public $onhand;
    public $price;
    public $image;
    public $quantity;
    public $status;

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

        return view('livewire.admin.settings.products.manage-products', [
            'products' => $products,
            'categories' => ProductCategory::where('status', 1)->get()
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
            'product_name' => 'required|unique:products',
            'description' => 'required',
            'price' => 'required',
            'min_qty' => 'required',
            // 'max_qty' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $image =  $this->image->store('photos', 'public');

        Product::create([
            'product_name' => strtoupper($this->product_name),
            'description' => strtoupper($this->description),
            'min_qty' => $this->min_qty,
            // 'max_qty' => $this->max_qty,
            'product_category_id' => $this->product_category_id,
            'price' => $this->price,
            'product_image_path' => $image
        ]);

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'PRODUCTS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'ADDED PRODUCT'
        ]);

        $this->resetFields();
        $this->dispatch('created');
    }

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->product_id = $id;

        $product_id = Product::findOrFail($id);

        $this->product_name = $product_id->product_name;
        $this->product_category_id = $product_id->product_category_id;
        $this->description = $product_id->description;
        $this->min_qty = $product_id->min_qty;
        $this->onhand = $product_id->total_qty;
        $this->price = $product_id->price;
        $this->image = $product_id->product_image_path;
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->product_id = $id;

        $product_id = Product::where('id', $id)->first();

        $this->product_name = $product_id->product_name;
    }

    public function editImage($id)
    {
        $this->modalImage = true;

        $this->product_id = $id;

        $product_id = Product::where('id', $id)->first();

        $this->product_name = $product_id->product_name;
    }

    public function updateImage()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $updateImage = Product::where('id', $this->product_id);

        $image =  $this->image->store('photos', 'public');

        $updateImage->update([
            'product_image_path' => $image
        ]);

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'PRODUCTS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED PRODUCT IMAGE'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function updateStatus()
    {
        $updateStatus = Product::where('id', $this->product_id);
        
        $status = $this->status == 'Active' ? 1 : 0;

        $updateStatus->update([
            'status' => $status
        ]);

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'PRODUCTS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'ADDED PRODUCT STATUS'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function update()
    {
        $this->validate([
            'product_name' => 'required',
            'product_category_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'min_qty' => 'required',
            'onhand' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $updateProduct = Product::where('id', $this->product_id);

        // $image =  $this->image->store('photos', 'public');

        $updateProduct->update([
            'product_name' => strtoupper($this->product_name),
            'description' => strtoupper($this->description),
            'min_qty' => $this->min_qty,
            'total_qty' => $this->onhand,
            'product_category_id' => $this->product_category_id,
            'price' => $this->price,
            // 'product_image_path' => $image
        ]);

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'PRODUCTS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED PRODUCT'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function view($id)
    {
        $this->modalView = true;

        $this->product_id = $id;

        $product_id = Product::where('id', $id)->first();

        $this->product_name = $product_id->product_name;
        $this->product_category_id = $product_id->category->category_name;
        $this->price = $product_id->price;
        $this->description = $product_id->description;
        $this->min_qty = $product_id->min_qty;
        $this->quantity = $product_id->total_qty;
        $this->status = $product_id->status;
    }

    public function export()
    {
        $data = Product::latest()->get();
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
            'log_name' => 'PRODUCTS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'EXPORTED PRODUCTS'
        ]);

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
