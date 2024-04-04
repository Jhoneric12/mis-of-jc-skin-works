<?php

namespace App\Livewire\Admin\LandingPage;

use App\Models\ConfigureDermatologist;
use Livewire\Component;

class Dermatologist extends Component
{
    public $dermaName;
    public $image;

    public function render()
    {
        $dermatologist = ConfigureDermatologist::first();

        $this->dermaName = $dermatologist->name;
        $this->image = $dermatologist->image_path;

        return view('livewire.admin.landing-page.dermatologist');
    }
}
