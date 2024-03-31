<?php

namespace App\Livewire\Admin\LandingPage;

use App\Models\ConfigureDermatologist;
use App\Models\HighlightsContent;
use App\Models\ConfigureAboutUs;
use Livewire\Component;

class Hero extends Component
{
    public $image;
    public $heroText;
    public $aboutUs;

    public function render()
    {
        $dermatologist = ConfigureDermatologist::first();
        $highlightContent = HighlightsContent::first();
        $aboutUs = ConfigureAboutUs::first();

        $this->image = $dermatologist->image_path;
        $this->heroText = $highlightContent->content;
        $this->aboutUs = $aboutUs->content;

        return view('livewire.admin.landing-page.hero');
    }
}
