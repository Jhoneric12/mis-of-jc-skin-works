<?php

namespace App\Livewire\Notification;

use App\Models\PatientNotif;
use Livewire\Component;

class Patient extends Component
{
    public function render()
    {
        return view('livewire.notification.patient', ['notifications' => PatientNotif::latest()->get()]);
    }
}
