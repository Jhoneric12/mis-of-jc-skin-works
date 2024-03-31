<?php

namespace App\Livewire\Admin\LandingPage;

use App\Models\Service;
use App\Models\ServiceCategory;
use Livewire\Component;

class Services extends Component
{
    public $category = 'All';

    public function render()
    {
        $query = Service::query()
            ->where('status', 1)
            ->orderBy('created_at', 'desc');

        if ($this->category !== 'All') {
            $query->where('service_category_id', $this->category);
        }

        $services = $query->get();

        return view('livewire.admin.landing-page.services', [
            'services' => $services,
            'categories' => ServiceCategory::where('status', 1)->get()
        ]);
    }
}
