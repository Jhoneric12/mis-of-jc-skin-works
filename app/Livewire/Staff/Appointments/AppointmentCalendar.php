<?php

namespace App\Livewire\Staff\Appointments;

use Livewire\Component;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AppointmentCalendar extends Component
{
    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $appointments = [];

    public function render()
    {
        $this->appointments = Appointment::where('specialist_id', Auth::user()->id)->whereIn('status', ['Confirmed', 'On-going', 'Cancelled', 'Completed'])->get();

        $appointments_today = Appointment::whereDate('date', Carbon::now()->toDateString())->count();

        $confirmed = Appointment::where('status', 'Confirmed')->where('specialist_id', Auth::user()->id)->count();
        $cancelled = Appointment::where('status', 'Cancelled')->where('specialist_id', Auth::user()->id)->count();
        $completed = Appointment::where('status', 'Completed')->where('specialist_id', Auth::user()->id)->count();
        $onGoing = Appointment::where('status', 'On-Going')->where('specialist_id', Auth::user()->id)->count();
        return view('livewire.staff.appointments.appointment-calendar', [
            'confirmed' => $confirmed,
            'cancelled' => $cancelled,
            'completed' => $completed,
            'ongoing' => $onGoing,
            'appointments_today' => $appointments_today,
        ]);
    }

    public function openModal()
    {
        $this->modalAdd = true;
    }

    public function closeModal()
    {
        $this->modalAdd = false;
        $this->modalUpdate = false;
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->reset();
        $this->resetValidation();
    }
}
