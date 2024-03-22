<?php

namespace App\Livewire\Admin\Settings\Promotions;

use App\Models\Promo;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Promotions extends Component
{
    use WithPagination;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $search = '';
    public $filter = 'All';

    public $price;
    public $promo_id;
    public $promo_name;
    public $description;
    public $status;

    public function render()
    {
        $promotion = Promo::query()
                ->where('promo_name', 'like', '%' . $this->search . '%')
                ->orderBy('created_at', 'desc');

                if ($this->filter !== 'All') {
                    $status = $this->filter === 'Active' ? 1 : 0;
                    $promotion->where('status', $status);
                }

            $promotions = $promotion->paginate(10);

        return view('livewire.admin.settings.promotions.promotions', [
            'promotions' => $promotions,
            'services' => Service::where('status', 1)->get()
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
    
    public function createPromotions()
    {
        $this->validate([
            'promo_name' => 'required|unique:promos',
            'price' => 'required',
            'description' => 'required'
        ]);

        Promo::create([
            'promo_name' => strtoupper($this->promo_name),
            'price' => $this->price,
            'description' => strtoupper($this->description)
        ]);

        $this->modalAdd = false;
        $this->resetFields();
        $this->dispatch('created');
    }

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->promo_id = $id;

        $promo_id = Promo::findOrFail($id);

        $this->promo_name = $promo_id->promo_name;
        $this->price = $promo_id->price;
        $this->description = $promo_id->description;
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->promo_id = $id;

        $promo = Promo::where('id', $id)->first();

        $this->promo_name = $promo->promo_name;
    }

    public function update()
    {
        $this->validate([
            'promo_name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);

        $updatePromo = Promo::where('id', $this->promo_id);

        $updatePromo->update([
            'promo_name' => strtoupper($this->promo_name),
            'price' => $this->price,
            'description' => strtoupper($this->description)
        ]);

        $this->modalUpdate = false;
        $this->resetFields();
        $this->dispatch('updated');
    }

    public function updateStatus()
    {
        $this->validate(['status' => 'required']);
        
        $updateStatus = Promo::where('id', $this->promo_id);
        
        $status = $this->status == 'Active' ? 1 : 0;

        $updateStatus->update([
            'status' => $status
        ]);

        $this->modalStatus = false;
        $this->dispatch('updated');
    }

    public function view($id)
    {
        $this->modalView = true;

        $promo = Promo::where('id', $id)->first();

        $this->promo_id = $promo->id;
        $this->promo_name = $promo->promo_name;
        $this->price = $promo->price;
        $this->description = $promo->description;
        $this->status = $promo->status;
    }
}
