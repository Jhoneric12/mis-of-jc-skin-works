<?php

namespace App\Livewire\Staff\Patient;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Appointment;
use App\Models\AppointmentSession;
use App\Models\AuditTrail;
use App\Models\OpenRateUs;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class SessionProgress extends Component
{
    use WithFileUploads;

    #[Url]
    public $appointment_id;
    #[Url]
    public $isProceed;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalComplete = false;
    public $reSchedule = false;
    public $modalImage = false;

    public $specialist_id;
    public $image;
    public $no_of_progress;
    public $progress_count;
    public $no_of_session;
    public $full_name;
    public $date;
    public $time;
    public $session_id;

    public function render()
    {

        $sessions = AppointmentSession::where('appointment_id', $this->appointment_id)->get();

        $this->no_of_session = Appointment::where('id', $this->appointment_id)->first();

        $this->full_name = $this->no_of_session->patient->first_name . " " . $this->no_of_session->patient->last_name;

        $this->no_of_progress = AppointmentSession::where('appointment_id', $this->appointment_id)->count();

         // Check if the session is completed hehe
         if ($this->no_of_progress == $this->no_of_session->service->nno_of_sessions)
         {
             $updateStatus = Appointment::where('id', $this->appointment_id)->first();
             $review = OpenRateUs::latest()->first();
             
             $review->update([
                'isOpen' => 1
             ]);
 
             $updateStatus->update([
                 'status' => 'Completed'
             ]);

            if ($this->isProceed)
            {
                $this->redirectRoute('staff-view-appointments', ['appointment_id' => $this->appointment_id]);
            }
         }

        return view('livewire.staff.patient.session-progress', ['sessions' => $sessions, 'specialists' => User::where('account_status', 1)->get(), 'services' => Service::where("status", 1 )]);
    }

    public function openModal()
    {
        $this->modalAdd = true;
    }

    public function closeModal()
    {
        $this->modalAdd = false;
        $this->modalUpdate = false;
        $this->modalImage = false;
        $this->reSchedule = false;
    }

    public function resetFields()
    {
        $this->modalAdd = false;
        $this->modalImage = false;
        $this->resetValidation();
    }

    public function create()
    {
        $this->validate([
            // 'specialist_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $specialist = Appointment::where('id', $this->appointment_id)->first();

        $image =  $this->image->store('photos', 'public');

        AppointmentSession::create([
            'appointment_id' => $this->appointment_id,
            'specialist' => $specialist->specialist->last_name,
            'image_path' => $image
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'SESSION',
            'user_type' => 'STAFF',
            'description' => 'ADDED SESSION'
        ]);
            

        $this->resetFields();
        $this->modalAdd = false;
        $this->dispatch('created');
    }

    public function reschedule()
    {
        $this->validate([
            'date' => 'required',
            'time' => 'required'
        ]);

        $appointment = Appointment::where('id', $this->appointment_id)->first();

        $appointment->update([
            'date' => $this->date,
            'time' => $this->time
        ]);

        $this->redirectRoute('staff-view-appointments', ['appointment_id' => $this->appointment_id]);
    }

    public function openReSchedule()
    {
        $this->reSchedule = true;
    }

    public function editImage($id)
    {
        $this->modalImage = true;

         $this->session_id = $id;
    }

    public function updateImage()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $updateImage = AppointmentSession::where('id', $this->session_id);

        $image =  $this->image->store('photos', 'public');

        $updateImage->update([
            'image_path' => $image
        ]);

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'SESSION',
            'user_type' => 'STAFF',
            'description' => 'UPDATED SESSION IMAGE'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }
}
