<?php

namespace App\Livewire\Admin\Settings\ConfigurePge;

use App\Http\Controllers\Admin\Settings\ConfigurePage\FeatureProducts;
use App\Models\AuditTrail;
use Livewire\Component;
use App\Models\FeaturedProduct;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class FeaturedProducts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $modalImage = false;

    public $product_name;
    public $description;
    public $image;
    public $feature_id;
    public $status;

    public function render()
    {
        $query = FeaturedProduct::query()
            ->orderBy('created_at', 'desc');

        $products = $query->paginate(5);

        return view('livewire.admin.settings.configure-pge.featured-products', [
            'products' => $products,
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
            'product_name' => 'required|unique:featured_products',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $image =  $this->image->store('photos', 'public');

        FeaturedProduct::create([
            'product_name' => $this->product_name,
            'description' => $this->description,
            'product_image_path' => $image
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'CONFIGURE PAGE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'ADDED FEATURE PRODUCTS'
        ]);

        $this->resetFields();
        $this->dispatch('created');
    }

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->feature_id = $id;

        $feature_id = FeaturedProduct::findOrFail($id);

        $this->product_name = $feature_id->product_name;
        $this->description = $feature_id->description;
        $this->image = $feature_id->prodcut_image_path;
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->feature_id = $id;

        $feature_id = FeaturedProduct::where('id', $id)->first();

        $this->product_name = $feature_id->product_name;
    }

    public function editImage($id)
    {
        $this->modalImage = true;

        $this->feature_id = $id;

        $feature_id = FeaturedProduct::where('id', $id)->first();

        $this->product_name = $feature_id->product_name;
    }

    public function updateImage()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $updateImage = FeaturedProduct::where('id', $this->feature_id);

        $image =  $this->image->store('photos', 'public');

        $updateImage->update([
            'product_image_path' => $image
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'CONFIGURE PAGE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED FEATURE PRODUCT IMAGE'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function updateStatus()
    {
        $updateStatus = FeaturedProduct::where('id', $this->feature_id);
        
        $status = $this->status == 'Active' ? 1 : 0;

        $this->validate(['status' => 'required']);

        $updateStatus->update([
            'status' => $status
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'CONFIGURE PAGE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED FEATURE PRODUCT STATUS'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function update()
    {
        $this->validate([
            'product_name' => 'required',
            'description' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $updateProduct = FeaturedProduct::where('id', $this->feature_id);

        // $image =  $this->image->store('photos', 'public');

        $updateProduct->update([
            'product_name' => $this->product_name,
            'description' => $this->description,
            // 'product_image_path' => $image
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'CONFIGURE PAGE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED FEATURE PRODUCT'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }
}
