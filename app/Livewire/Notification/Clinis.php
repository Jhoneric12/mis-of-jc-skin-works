<?php

namespace App\Livewire\Notification;

use App\Models\ClinicNotif;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Clinis extends Component
{
    public function render()
    {
        return view('livewire.notification.clinis', ['notifications' => ClinicNotif::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get()]);
    }
}
