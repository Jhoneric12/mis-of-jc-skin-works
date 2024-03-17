<?php

namespace App\Livewire\Admin\Inventory;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\ProductCategory;

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

        $this->resetFields();
        $this->dispatch('created');
    }

    // public function view($id)
    // {
    //     $this->modalView = true;

    //     $this->product_id = $id;

    //     $product_id = Inventory::where('id', $id)->first();

    //     $this->product_name = $product_id->product->product_name; 

        

    // }
}
