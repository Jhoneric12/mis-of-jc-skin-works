<?php

namespace App\Livewire\Admin\LandingPage;

use App\Models\Banner;
use Livewire\Component;

class CarouseBanner extends Component
{
    public function render()
    {
        $banners = Banner::where('status', 1)->get();

        return view('livewire.admin.landing-page.carouse-banner', [
            'banners' => $banners
        ]);
    }
}
