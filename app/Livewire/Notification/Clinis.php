<?php

namespace App\Livewire\Notification;

use App\Models\ClinicNotif;
use Livewire\Component;

class Clinis extends Component
{
    public function render()
    {
        return view('livewire.notification.clinis', ['notifications' => ClinicNotif::whereIn('type', ['admin', 'staff', 'patient'])->orderBy('created_at', 'desc')->get()]);
    }
}
