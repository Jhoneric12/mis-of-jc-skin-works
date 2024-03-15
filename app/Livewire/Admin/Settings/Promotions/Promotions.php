<?php

namespace App\Livewire\Admin\Settings\Promotions;

use App\Models\Promotion;
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
    public $filter = 'Active';

    public $service;

    public function render()
    {
        $promotion = Promotion::query()
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
        $this->validate(['service' => 'required|unique:promotions']);

        Promotion::create([
            'service' => $this->service
        ]);

        $this->modalAdd = false;
        $this->resetFields();
        $this->dispatch('created');

    }
}
