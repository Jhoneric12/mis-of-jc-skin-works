<?php

namespace App\Livewire\Patient\Dashboard;

use App\Mail\AppointmentExpired;
use App\Mail\AppointmentTomorrow;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Appointment;
use App\Models\Feedback;
use App\Models\OpenRateUs;
use App\Models\PatientNotif;
use Illuminate\Support\Facades\Mail;

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
            ->whereIn('status', ['Cancelled', 'Completed', 'On-going', 'Confirmed'])
            ->whereDate('date', '=',  Carbon::today()->toDateString())
            ->latest()
            ->paginate(10);

        return view('livewire.patient.dashboard.dashboard', ['appointments' => $appointments]);
    }

    public function mount()
    {
        // Email Reminders
        $this->tommorowAppointments();

        //Expired Appointments
        $this->appointmentExpired();
    }

    public function tommorowAppointments()
    {
        $tomorrowAppointments = Appointment::whereDate('date', Carbon::tomorrow())
            ->where('status', 'Confirmed')
            ->where('patient_id', Auth::user()->id)
            ->whereNull('reminders_sent_at')
            ->latest()
            ->get();

        foreach ($tomorrowAppointments as $appointment) {

                Mail::to($appointment->patient->email)
                    ->send(new AppointmentTomorrow($appointment));

                PatientNotif::create([
                    'user_id' => Auth::user()->id,
                    'description' => 'You have an appointment scheduled for tomorrow for ' . $appointment->service->service_name
                ]);

                $appointment->update(['reminders_sent_at' => Carbon::now()]);
        }
    }

    public function appointmentExpired()
    {
        $expiredAppointments = Appointment::whereDate('date', '<', Carbon::today())
            ->whereIn('status', ['Scheduled', 'Confirmed'])
            ->latest()
            ->get();

        foreach ($expiredAppointments as $appointment) {

                Mail::to($appointment->patient->email)
                    ->send(new AppointmentExpired($appointment));

                PatientNotif::create([
                    'user_id' => Auth::user()->id,
                    'description' => 'Your appointment has expired for Appointment No. ' . $appointment->id
                ]);

                $appointment->update(['status' => 'Cancelled']);
        }
    }

    public function closeModal()
    {
        $this->review->update([
            'isOpen' => 0
        ]);

        $this->modalReview = false;
        $this->modalSucess = false;
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
