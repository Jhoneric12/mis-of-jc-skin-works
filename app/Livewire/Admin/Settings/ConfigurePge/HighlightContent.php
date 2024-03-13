<?php

namespace App\Livewire\Admin\Settings\ConfigurePge;

use Livewire\Component;
use App\Models\HighlightsContent;  

class HighlightContent extends Component
{
    public $content;
    public $content_id;

    public function render()
    {
        $contents = HighlightsContent::first();

        $this->content = $contents->content;
        $this->content_id = $contents->id;
        
        return view('livewire.admin.settings.configure-pge.highlight-content');
    }

    public function update()
    {
        $this->validate([
            'content' => 'required'
        ]);

        $updateContent = HighlightsContent::where('id', $this->content_id);

        $updateContent->update([
            'content' => $this->content
        ]);

        $this->dispatch('updated');
    }
}
