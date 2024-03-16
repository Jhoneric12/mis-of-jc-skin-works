<?php

namespace App\Livewire\Admin\ActivityLog;

use App\Models\AuditTrail;
use Livewire\Component;

class ActivityLog extends Component
{
    public function render()
    {
        $logs = AuditTrail::orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.admin.activity-log.activity-log', [
            'logs' => $logs
        ]);
    }
}
