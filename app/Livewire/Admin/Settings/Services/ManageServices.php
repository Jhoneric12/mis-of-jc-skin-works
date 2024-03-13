<?php

namespace App\Livewire\Admin\Settings\Services;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;
use App\Models\ServiceCategory;

class ManageServices extends Component
{
    use WithPagination;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $search = '';
    public $filter = 'Active';
    public $category = 'All';

    public $service_name;
    public $service_id;
    public $service_category_id;
    public $description;
    public $price;
    public $status;
    public $sessions;

    public function render()
    {
        $query = Service::query()
            ->where('service_name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc');

        if ($this->filter !== 'All') {
            $status = $this->filter === 'Active' ? 1 : 0;
            $query->where('status', $status);
        }

        if ($this->category !== 'All') {
            $query->where('service_category_id', $this->category);
        }

        $services = $query->paginate(10);

        return view('livewire.admin.settings.services.manage-services', [
            'services' => $services,
            'categories' => ServiceCategory::all()
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
            'service_name' => 'required|unique:services',
            'description' => 'required',
            'price' => 'required',
            'sessions' => 'required'
        ]);

        Service::create([
            'service_name' => strtoupper($this->service_name),
            'service_category_id' => $this->service_category_id,
            'description' => strtoupper($this->description),
            'price' => $this->price,
            'nno_of_sessions' => $this->sessions
        ]);

        $this->dispatch('created');
        $this->modalAdd = false;
        $this->resetFields();
    }

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->service_id = $id;

        $service_id = Service::where('id', $id)->first();

        $this->service_name = $service_id->service_name;
        $this->service_category_id = $service_id->service_category_id;
        $this->description = $service_id->description;
        $this->price = $service_id->price;
        $this->status = $service_id->status;
        $this->sessions = $service_id->nno_of_sessions;

    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->service_id = $id;

        $service_id = Service::where('id', $id)->first();

        $this->service_name = $service_id->service_name;
    }

    public function updateStatus()
    {
        $this->validate(['status' => 'required']);
        
        $updateStatus = Service::where('id', $this->service_id);
        
        $status = $this->status == 'Active' ? 1 : 0;

        $updateStatus->update([
            'status' => $status
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function update()
    {
        $this->validate([
            'service_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'sessions' => 'required'
        ]);

        $updateService = Service::where('id', $this->service_id);

        $updateService->update([
            'service_name' => strtoupper($this->service_name),
            'service_category_id' => $this->service_category_id,
            'description' => strtoupper($this->description),
            'price' => $this->price,
            'nno_of_sessions' => $this->sessions,
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function view($id)
    {
        $this->modalView = true;

        $this->service_id = $id;

        $service_category_id = Service::where('id', $id)->first();

        $this->service_name = $service_category_id->service_name;
        $this->service_category_id = $service_category_id->category->category_name;
        $this->price = $service_category_id->price;
        $this->description = $service_category_id->description;
        $this->status = $service_category_id->status;
        $this->sessions = $service_category_id->nno_of_sessions;
    }
}
