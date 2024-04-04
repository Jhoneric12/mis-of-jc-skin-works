<?php

namespace App\Livewire\Admin\Settings\ConfigurePge;

use App\Models\AuditTrail;
use Livewire\Component;
use App\Models\ConfigureTestimonials;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;

class Testimonials extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;

    public $name;
    public $address;
    public $review;
    public $image;
    public $testimonial_id;
    public $status;

    public function render()
    {
        $query = Feedback::query()
            ->orderBy('created_at', 'desc');

        $testimonials = $query->paginate(10);

        return view('livewire.admin.settings.configure-pge.testimonials', [
            'testimonials' => $testimonials,
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
            'name' => 'required',
            'address' => 'required',
            'review' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $image =  $this->image->store('photos', 'public');

        ConfigureTestimonials::create([
            'name' => $this->name,
            'address' => $this->address,
            'review' => $this->review,
            'image_path' => $image
        ]);

        $this->resetFields();
        $this->dispatch('created');
    }

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->testimonial_id = $id;

        $testimonial_id = ConfigureTestimonials::findOrFail($id);

        $this->name = $testimonial_id->name;
        $this->address = $testimonial_id->address;
        $this->review = $testimonial_id->review;
        $this->image = $testimonial_id->image_path;
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->testimonial_id = $id;

        $testimonial_id = Feedback::where('id', $id)->first();

        $this->name = $testimonial_id->patient->first_name . " " . $testimonial_id->patient->last_name;
    }

    public function updateStatus()
    {
        $updateStatus = Feedback::where('id', $this->testimonial_id);
        
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
            'description' => 'UPDATED TESTIMONIALS STATUS'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'address' => 'required',
            'review' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $updateTestimonial = Feedback::where('id', $this->testimonial_id);

        $image =  $this->image->store('photos', 'public');

        $updateTestimonial->update([
            'name' => $this->name,
            'address' => $this->address,
            'review' => $this->review,
            'image_path' => $image
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }
}
