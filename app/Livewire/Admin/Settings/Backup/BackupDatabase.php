<?php

namespace App\Livewire\Admin\Settings\Backup;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Spatie\Backup\Tasks\Backup\BackupJob;

class BackupDatabase extends Component
{
    public $backupPath;

    public function render()
    {
        return view('livewire.admin.settings.backup.backup-database');
    }

    public function backup()
    {
        Artisan::call('backup:run');

        session()->flash('message', 'Backup completed successfully!');
    }
}
