<?php

namespace App\Livewire\Admin\Settings\ConfigurePge;

use App\Models\ClinicInformation;
use Livewire\Component;

class ClinicDetails extends Component
{
    public $description;
    public $weekly_sched;
    public $time_sched;
    public $email;
    public $contact;
    public $fb_link;
    public $twitter_link;
    public $home_address;
    public $clinic_info;

    public function render()
    {
        $this->clinic_info = ClinicInformation::latest()->first();

        $this->description = $this->clinic_info->clinic_description;
        $this->weekly_sched = $this->clinic_info->weekly_sched;
        $this->time_sched = $this->clinic_info->time_sched;
        $this->email = $this->clinic_info->email;
        $this->contact = $this->clinic_info->contact_number;
        $this->fb_link = $this->clinic_info->facebook;
        $this->twitter_link = $this->clinic_info->twitter;
        $this->home_address = $this->clinic_info->home_address;

        return view('livewire.admin.settings.configure-pge.clinic-details');
    }

    public function update()
    {
        $this->validate([
            'description' => 'required',
            'weekly_sched' => 'required',
            'time_sched' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'fb_link' => 'required',
            'twitter_link' => 'required',
            'home_address' => 'required',
        ]);

        // $this->clinic_info = ClinicInformation::latest()->first();

        $this->clinic_info->update([
            'clinic_description' => $this->description,
            'weekly_sched' => $this->weekly_sched,
            'time_sched' => $this->time_sched,
            'email' => $this->email,
            'contact_number' => $this->contact,
            'facebook' => $this->fb_link,
            'twitter' => $this->twitter_link,
            'home_address' => $this->home_address,
        ]);

       $this->dispatch('updated');
    }
}
