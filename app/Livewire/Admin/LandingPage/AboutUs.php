<?php

namespace App\Livewire\Admin\LandingPage;

use App\Models\ConfigureAboutUs;
use Livewire\Component;

class AboutUs extends Component
{
    public $title;
    public $content;

    public function render()
    {
        $about_us = ConfigureAboutUs::first();

        $this->title = $about_us->title;
        $this->content = $about_us->content;
        
        return view('livewire.admin.landing-page.about-us');
    }
}
