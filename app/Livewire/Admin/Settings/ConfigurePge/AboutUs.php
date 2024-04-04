<?php

namespace App\Livewire\Admin\Settings\ConfigurePge;

use App\Models\AuditTrail;
use Livewire\Component;
use App\Models\ConfigureAboutUs;
use Illuminate\Support\Facades\Auth;

class AboutUs extends Component
{

    public $title;
    public $content;
    public $about_id;

    public function render()
    {
        $abouts = ConfigureAboutUs::first();

        $this->title = $abouts->title;
        $this->content = $abouts->content;
        $this->about_id = $abouts->id;

        return view('livewire.admin.settings.configure-pge.about-us');
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $updateAbout = ConfigureAboutUs::where('id', $this->about_id);

        $updateAbout->update([
            'title' => $this->title,
            'content' => $this->content
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'CONFIGURE PAGE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED ABOUT US'
        ]);

        $this->dispatch('updated');
    }
}
