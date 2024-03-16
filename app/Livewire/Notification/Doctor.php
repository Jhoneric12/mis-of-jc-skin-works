<?php

namespace App\Livewire\Notification;

use App\Models\ClinicNotif;
use Livewire\Component;

class Doctor extends Component
{
    public function render()
    {
        return view('livewire.notification.doctor', ['notifications' => ClinicNotif::where('type', 'patient')->orderBy('created_at', 'desc')->get()]);
    }
}
