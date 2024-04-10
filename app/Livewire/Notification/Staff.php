<?php

namespace App\Livewire\Notification;

use App\Models\ClinicNotif;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Staff extends Component
{
    public function render()
    {
        return view('livewire.notification.staff', ['notifications' => ClinicNotif::orderBy('created_at', 'desc')->get()]);
    }
}
