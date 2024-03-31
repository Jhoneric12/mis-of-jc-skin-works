<?php

namespace App\Livewire\Admin\LandingPage;

use App\Models\FeaturedProduct;
use Livewire\Component;

class Carousel extends Component
{
    public function render()
    {
        $featuredProducts = FeaturedProduct::where('status', 1)->get();

        return view('livewire.admin.landing-page.carousel', [
            'products' => $featuredProducts
        ]);
    }
}
