<?php

namespace App\Livewire\Patient\SkinRecords;

use App\Models\Appointment;
use App\Models\AppointmentSession;
use Livewire\Attributes\Url;
use Livewire\Component;

class SessionProgress extends Component
{
    #[Url]
    public $appointment_id;

    public $no_of_progress;
    public $progress_count;
    public $no_of_session;

    public function render()
    {
        $sessions = AppointmentSession::where('appointment_id', $this->appointment_id)->get();

        $this->no_of_session = Appointment::where('id', $this->appointment_id)->first();

        $this->no_of_progress = AppointmentSession::where('appointment_id', $this->appointment_id)->count();

        return view('livewire.patient.skin-records.session-progress', [
            'sessions' => $sessions
        ]);
    }
}
