<?php

namespace App\Livewire\Admin\Settings\Backup;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class BackupDatabase extends Component
{
    public function render()
    {
        return view('livewire.admin.settings.backup.backup-database');
    }

    public function backup()
    {
        Artisan::call('backup:run');

        session()->flash('success', 'Database backup created successfully.');
    }
}
