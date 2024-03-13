<?php

namespace App\Livewire\Admin\Billing;

use Livewire\Component;
use App\Models\Service;

class ServicesTable extends Component
{
    public $serviceSearch;

    public function render()
    {
        $serviceQuery = Service::query()
        ->where('service_name', 'like', '%' . $this->serviceSearch . '%')
        ->orderBy('created_at', 'desc');

        $services = $serviceQuery->paginate(3);

        return view('livewire.admin.billing.services-table', [
            'services' => $services
        ]);
    }
}
