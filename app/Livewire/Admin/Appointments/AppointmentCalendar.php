<?php

namespace App\Livewire\Admin\Appointments;

use Livewire\Component;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentCalendar extends Component
{
    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $appointments = [];

    public function render()
    {
        $this->appointments = Appointment::whereIn('status', ['Confirmed', 'On-going', 'Cancelled', 'Completed'])->get();

        $appointments_today = Appointment::whereDate('date', Carbon::now()->toDateString())->count();

        $confirmed = Appointment::where('status', 'Confirmed')->count();
        $cancelled = Appointment::where('status', 'Cancelled')->count();
        $completed = Appointment::where('status', 'Completed')->count();
        $onGoing = Appointment::where('status', 'On-Going')->count();
        return view('livewire.admin.appointments.appointment-calendar', [
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
