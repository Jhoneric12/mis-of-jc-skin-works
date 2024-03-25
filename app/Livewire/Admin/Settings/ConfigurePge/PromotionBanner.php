<?php

namespace App\Livewire\Admin\Settings\ConfigurePge;

use App\Models\AuditTrail;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PromotionBanner extends Component
{
    use WithFileUploads;

    public $search;
    public $filter = 'All';

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $modalImage = false;

    public $promo_title;
    public $image;
    public $promo_id;
    public $status;

    public function render()
    {
        $query = Banner::query()
            ->where('promo_title', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc');

        if ($this->filter !== 'All') {
            $status = $this->filter === 'Active' ? 1 : 0;
            $query->where('status', $status);
        }

        $banners = $query->paginate(10);

        return view('livewire.admin.settings.configure-pge.promotion-banner', [
            'banners' => $banners
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
            'promo_title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $image =  $this->image->store('photos', 'public');

        Banner::create([
            'promo_title' => strtoupper($this->promo_title),
            'image' => $image
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'CONFIGURE PAGE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'ADDED PROMO BANNER'
        ]);

        $this->resetFields();
        $this->dispatch('created');
    }

    public function editModal($id) 
    {
        $this->modalUpdate = true;

        $this->promo_id = $id;

        $promo_id = Banner::where('id', $id)->first();

        $this->promo_title = $promo_id->promo_title;
        $this->image = $promo_id->image;
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->promo_id = $id;
    }

    public function editImage($id)
    {
        $this->modalImage = true;

        $this->promo_id = $id;

        $promo_id = Banner::where('id', $id)->first();

        $this->promo_title = $promo_id->promo_title;
    }

    public function updateImage()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $updateImage = Banner::where('id', $this->promo_id);

        $image =  $this->image->store('photos', 'public');

        $updateImage->update([
            'image' => $image
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'CONFIGURE PAGE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED BANNER IMAGE'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function update() 
    {
        $this->validate([
            'promo_title' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        // $image =  $this->image->store('photos', 'public');

        $updateBanner = Banner::where('id', $this->promo_id)->first();

        $updateBanner->update([
            'promo_title' => strtoupper($this->promo_title),
            // 'image' => $image
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'CONFIGURE PAGE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED PROMO BANNER'
        ]);

        $this->dispatch('updated');
        $this->modalUpdate = false;
        $this->resetFields();
    }

    public function updateStatus()
    {
        $this->validate([
            'status' => 'required'
        ]);

        $updateStatus = Banner::where('id', $this->promo_id)->first();

        $status = $this->status == 'Active' ? 1 : 0;

        $updateStatus->update([
            'status' => $status
        ]);

        $this->dispatch('updated');
        $this->modalUpdate = false;
        $this->resetFields();
    }
}
