<?php

namespace App\Livewire\Admin\Settings\Schedule;

use App\Models\AuditTrail;
use Livewire\Component;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ManageSchedule extends Component
{
    public $schedule;
    public $weeklySchedule = [];
    public $openTime;
    public $closingTime;

    public function render()
    {
        return view('livewire.admin.settings.schedule.manage-schedule');
    }

    public function mount()
    {
        // Fetch the existing schedule from the database
        $existingSchedule = Schedule::latest()->first();
        $this->schedule = Schedule::latest()->first();


        if ($existingSchedule) {
            // Deserialize the weekly schedule array
            $this->weeklySchedule = unserialize($existingSchedule->weekly_schedule);
            $this->openTime = $existingSchedule->open_time;
            $this->closingTime = $existingSchedule->closing_time;
        }
    }

    public function updateSchedule()
    {
        // Serialize the updated weekly schedule array
        $serializedSchedule = serialize($this->weeklySchedule);
        
        // Update the schedule in the database
        $this->schedule->update([
            'weekly_schedule' => $serializedSchedule,
            'open_time' => $this->openTime,
            'closing_time' => $this->closingTime,
        ]);

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'SCHEDULE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED CLINIC SCHEDULE'
        ]);

        $this->dispatch('updated');
    }

    // public function createSchedule()
    // {
    //     // Serialize the weekly schedule array
    //     $serializedSchedule = serialize($this->weeklySchedule);
        
    //     // Store the serialized schedule in the database
    //     Schedule::create([
    //         'weekly_schedule' => $serializedSchedule,
    //         'open_time' => $this->openTime,
    //         'closing_time' => $this->closingTime,
    //     ]);

    //     // Reset the form fields after submission
    //     $this->reset(['weeklySchedule', 'openTime', 'closingTime']);
    // }

}
