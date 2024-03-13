<?php

namespace App\Livewire\Admin\Settings\ConfigurePge;

use Livewire\Component;
use App\Models\ConfigureAboutUs;

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

        $this->dispatch('updated');
    }
}
