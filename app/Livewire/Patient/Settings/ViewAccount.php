<?php

namespace App\Livewire\Patient\Settings;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewAccount extends Component
{
    public function render()
    {
        $patients = User::where('id', Auth::user()->id)->first();

        return view('livewire.patient.settings.view-account', [
            'patient' => $patients
        ]);
    }
}
