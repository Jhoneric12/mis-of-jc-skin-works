<?php

namespace App\Livewire\Patient;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $patientName;
    
    public function render()
    {
        $this->patientName = Auth::user()->first_name;

        return view('livewire.patient.dashboard');
    }
}
