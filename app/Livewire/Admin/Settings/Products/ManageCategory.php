<?php

namespace App\Livewire\Admin\Settings\Products;

use Livewire\Component;
use App\Models\ProductCategory;
use Livewire\WithPagination;

class ManageCategory extends Component
{
    use WithPagination;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $search = '';
    public $filter = 'Active';

    public $category_id;
    public $category_name;
    public $status;

    public function render()
    {
        $query = ProductCategory::query()
            ->where('category_name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc');

        if ($this->filter !== 'All') {
            $status = $this->filter === 'Active' ? 1 : 0;
            $query->where('status', $status);
        }

        $categories = $query->paginate(5);

        return view('livewire.admin.settings.products.manage-category', compact('categories'));
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
    
    public function createCategory()
    {
        $this->validate(['category_name' => 'required|unique:product_categories']);

        ProductCategory::create([
            'category_name' => strtoupper($this->category_name)
        ]);

        $this->modalAdd = false;
        $this->resetFields();
        $this->dispatch('category-created');

    }

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->category_id = $id;

        $category_id = ProductCategory::where('category_id', $id)->first();

        $this->category_name = $category_id->category_name;
        $this->status = $category_id->status;
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->category_id = $id;

        $category_id = ProductCategory::where('category_id', $id)->first();

        $this->category_name = $category_id->category_name;
    }

    public function updateStatus()
    {
        $this->validate(['status' => 'required']);
        
        $updateStatus = ProductCategory::where('category_id', $this->category_id);
        
        $status = $this->status == 'Active' ? 1 : 0;

        $updateStatus->update([
            'status' => $status
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function updateCategory()
    {
        $this->validate([
            'category_name' => 'required'
        ]);

        $updateCategory = ProductCategory::where('category_id', $this->category_id)->first();

        $updateCategory->update([
            'category_name' => strtoupper($this->category_name),
        ]);

        $this->resetFields();
        $this->dispatch('category-updated');
    }

    public function viewCategory($id)
    {
        $this->modalView = true;

        $this->category_id = $id;

        $category_id = ProductCategory::where('category_id', $id)->first();

        $this->category_name = $category_id->category_name;
        $this->status = $category_id->status;

    }
}
