<?php

namespace App\Livewire\Admin\LandingPage;

use App\Models\Feedback;
use Livewire\Component;

class Testimonials extends Component
{
    public function render()
    {
        $testimonials = Feedback::where('status', 1)->limit(3)->get();

        return view('livewire.admin.landing-page.testimonials', [
            'testimonials' => $testimonials
        ]);
    }
}
