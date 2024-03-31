<?php

namespace App\Livewire\Admin\LandingPage;

use App\Models\ClinicInformation;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $footer = ClinicInformation::latest()->first();

        return view('livewire.admin.landing-page.footer', [
            'footer' => $footer
        ]);
    }
}
