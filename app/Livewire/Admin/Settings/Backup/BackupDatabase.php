<?php

namespace App\Livewire\Admin\Settings\Backup;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;

class BackupDatabase extends Component
{
    public $backupPath;

    public function render()
    {
        return view('livewire.admin.settings.backup.backup-database');
    }

    public function backup()
    {
        // $backupJobFactory = new BackupJobFactory();

        // $backupJob = $backupJobFactory->createFromArray(config('backup'));

        // $backupJob->disableSignals();

        // $backupJob->run();

        Artisan::call('backup:run');

        Session::flash('success', 'Backup sucesssfully');
    }
}
