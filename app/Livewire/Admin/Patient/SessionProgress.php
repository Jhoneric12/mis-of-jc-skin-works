<?php

namespace App\Livewire\Admin\Patient;

use App\Mail\AppointmentCreated;
use Livewire\Component;
USE Livewire\Attributes\Url;
use App\Models\Appointment;
use App\Models\AppointmentSession;
use App\Models\AuditTrail;
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

    public $specialist_id;
    public $image;
    public $no_of_progress;
    public $progress_count;
    public $no_of_session;
    public $full_name;
    public $date;
    public $time;

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
 
             $updateStatus->update([
                 'status' => 'Completed'
             ]);

            if ($this->isProceed)
            {
                $this->redirectRoute('view-appointments', ['appointment_id' => $this->appointment_id]);
            }
         }

        return view('livewire.admin.patient.session-progress', ['sessions' => $sessions, 'specialists' => User::where('account_status', 1)->get(), 'services' => Service::where("status", 1 )]);
    }

    public function openModal()
    {
        $this->modalAdd = true;
    }

    public function closeModal()
    {
        $this->modalAdd = false;
        $this->modalUpdate = false;
        $this->reSchedule = false;
    }

    public function resetFields()
    {
        $this->modalAdd = false;
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
            'log_name' => 'SESSION PROGRESS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'ADDED SESSION PROGRESS'
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

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'SESSION PROGRESS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'RE-SCHEDULED AN APPOINTMENT'
        ]);

        $this->redirectRoute('view-appointments', ['appointment_id' => $this->appointment_id]);
    }

    public function openReSchedule()
    {
        $this->reSchedule = true;
    }
}
