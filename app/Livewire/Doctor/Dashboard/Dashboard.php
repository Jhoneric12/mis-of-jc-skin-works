<?php

namespace App\Livewire\Doctor\Dashboard;

use App\Mail\AppointmentConfirmed;
use App\Mail\AppointmentDeclined;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Prescription;
use Illuminate\Support\Facades\Mail;

class Dashboard extends Component
{
    public $search;
    public $filter;
    public $isOnline;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $appointment_id;
    public $status;

    public function render()
    {
        $appointments = Appointment::where('specialist_id', Auth::user()->id)
            ->whereIn('status', ['On-going', 'Confirmed', 'Completed', 'Cancelled'])
            ->whereDate('date', '=',  Carbon::today()->toDateString())
            ->latest()
            ->paginate(5);

        $pending_appointments = Appointment::where('status', 'Scheduled')
                        ->where('specialist_id', Auth::id())
                        ->orderBy('date', 'asc')
                        ->paginate(10);

        $appointment_today = $appointments->count();

        $total_patient = User::where('role', 0)->count();

        $total_prescription = Prescription::all()->count();

        $treated_patients = Appointment::where('status', 'Completed')->where('specialist_id', Auth::user()->id)->count();

        return view('livewire.doctor.dashboard.dashboard', ['appointments' => $appointments, 'appointment_today' => $appointment_today, 'total_patients' => $total_patient, 'total_prescriptions' => $total_prescription, 'treated_patients' => $treated_patients, 'pending_appointments' => $pending_appointments]);
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->appointment_id = $id;

        $appointment_id = Appointment::where('id', $id)->first();

        $this->appointment_id = $appointment_id->id;
    }

    public function updateStatus()
    {
        $updateStatus = Appointment::where('id', $this->appointment_id);

        $this->validate(['status' => 'required']);

        $updateStatus->update([
            'status' => $this->status
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function confirm($id)
    {
        $updateStatus = Appointment::where('id', $id)->first();

        $updateStatus->update([
            'status' => 'Confirmed'
        ]);

        // Send confirmation email to the patient
        Mail::to($updateStatus->patient->email)->send(new AppointmentConfirmed($updateStatus));

        $this->dispatch('confirmed');

    }

    public function cancel($id)
    {
        $updateStatus = Appointment::where('id', $id)->first();

        $updateStatus->update([
            'status' => 'Cancelled'
        ]);

        // Send confirmation email to the patient
        Mail::to($updateStatus->patient->email)->send(new AppointmentDeclined($updateStatus));

        $this->dispatch('cancelled');
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
