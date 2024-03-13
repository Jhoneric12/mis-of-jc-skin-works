<?php

namespace App\Livewire\Admin\Patient;

use App\Mail\AppointmentCreated;
use Livewire\Component;
USE Livewire\Attributes\Url;
use App\Models\Appointment;
use App\Models\AppointmentSession;
use App\Models\User;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SessionProgress extends Component
{
    use WithFileUploads;

    #[Url(keep: true)]
    public $appointment_id;

    public $modalAdd = false;
    public $modalUpdate = false;

    public $specialist_id;
    public $image;
    public $no_of_progress;
    public $no_of_session;

    public function render()
    {
        $sessions = AppointmentSession::where('appointment_id', $this->appointment_id)->get();

        $this->no_of_session = Appointment::where('id', $this->appointment_id)->first();

        $this->no_of_progress = AppointmentSession::where('appointment_id', $this->appointment_id)->count();

        // Check if the number of sessions is equal to the number of progress updates
        if ($this->no_of_progress == $this->no_of_session->number_of_sessions) {
            AppointmentSession::where('appointment_id', $this->appointment_id)->update(['status' => 'Done']);
        }

        return view('livewire.admin.patient.session-progress', ['sessions' => $sessions, 'specialists' => User::where('account_status', 1)->get()]);
    }

    public function openModal()
    {
        $this->modalAdd = true;
    }

    public function closeModal()
    {
        $this->modalAdd = false;
        $this->modalUpdate = false;
    }

    public function resetFields()
    {
        $this->modalAdd = false;
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate([
            'specialist_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $image =  $this->image->store('photos', 'public');

        AppointmentSession::create([
            'appointment_id' => $this->appointment_id,
            'specialist' => $this->specialist_id,
            'image_path' => $image
        ]);

        // $this->resetFields();
        $this->modalAdd = false;
        $this->dispatch('created');
    }
}
