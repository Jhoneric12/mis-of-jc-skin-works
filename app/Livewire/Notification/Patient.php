<?php

namespace App\Livewire\Notification;

use App\Models\PatientNotif;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Patient extends Component
{
    public function render()
    {
        return view('livewire.notification.patient', ['notifications' => PatientNotif::where('user_id', Auth::user()->id)->get()]);
    }
}
