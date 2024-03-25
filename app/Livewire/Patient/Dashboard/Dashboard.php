<?php

namespace App\Livewire\Patient\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Feedback;
use App\Models\OpenRateUs;

class Dashboard extends Component
{
    public $patientName;
    public $modalReview;
    public $modalSucess;
    public $review;
    public $rating = 1;
    public $message;

    public function render()
    {
        $this->patientName = Auth::user()->first_name . " " . Auth::user()->last_name;

        // Open Review modal
        $this->review = OpenRateUs::latest()->first();

        $this->modalReview = $this->review->isOpen;

        // Retrieve appointments with status 'Confirmed' within the current month
        $appointments = Appointment::where('patient_id', Auth::user()->id)
            ->whereIn('status', ['Cancelled', 'Completed', 'On-going'])
            ->whereDate('date', '=',  Carbon::today()->toDateString())
            ->latest()
            ->paginate(5);

        return view('livewire.patient.dashboard.dashboard', ['appointments' => $appointments]);
    }

    public function closeModal()
    {
        $this->review->update([
            'isOpen' => 0
        ]);

        $this->reset();
    }
    
    public function closeSucess()
    {
        $this->modalSucess = false;
    }

    public function create()
    {
        $this->validate([
            'rating' => 'required',
            'message' => 'required'
        ]);

        Feedback::create([
            'patient_id' => Auth::user()->id,
            'rating' => $this->rating,
            'message' => $this->message
        ]);

        $this->closeModal();
        $this->modalSucess = true;
    }
}
