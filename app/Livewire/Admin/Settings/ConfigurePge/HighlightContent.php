<?php

namespace App\Livewire\Admin\Settings\ConfigurePge;

use App\Models\AuditTrail;
use Livewire\Component;
use App\Models\HighlightsContent;
use Illuminate\Support\Facades\Auth;

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

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'CONFIGURE PAGE',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED HIGHLIGHT CONTENT'
        ]);

        $this->dispatch('updated');
    }
}
