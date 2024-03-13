<?php

namespace App\Livewire\Admin\Settings\ConfigurePge;

use Livewire\Component;
use App\Models\ConfigureDermatologist;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class Dermatologist extends Component
{
    use WithFileUploads;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;

    public $name;
    public $image;
    public $derma_id;

    public function render()
    {
        $dermatologists = ConfigureDermatologist::all();

        // $dermatologists = ConfigureDermatologist::first();

        // $this->name = $dermatologists->name;
        // $this->image = $dermatologists->image_path;
        // $this->derma_id = $dermatologists->id;

        return view('livewire.admin.settings.configure-pge.dermatologist', compact('dermatologists'));
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $updateDermatologist = ConfigureDermatologist::find($this->derma_id);

        $imagePath = $this->image->store('photos', 'public');
        
        $updateDermatologist->update([
            'name' => $this->name,
            'image_path' => $imagePath
        ]);

        $this->modalUpdate = false;
        $this->dispatch('updated');
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

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->derma_id = $id;

        $dermatoligist_id = ConfigureDermatologist::findOrFail($id);

        $this->name = $dermatoligist_id->name;
        $this->image = $dermatoligist_id->image_patj;
    }


}
