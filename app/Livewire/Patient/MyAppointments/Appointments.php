<?php

namespace App\Livewire\Patient\MyAppointments;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Mail\AppointmentCreated;
use App\Mail\AppointmentExpired;
use App\Mail\AppointmentTomorrow;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class Appointments extends Component
{
    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $search = '';
    public $filter = 'All';

    public $appointment_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $service_id;
    public $service_name;
    public $specialist_name;
    public $full_name;
    public $specialist_id;
    public $date;
    public $time;
    public $setting = 'Online';
    public $status = 'Scheduled';
    public $cancelStatus = 'Cancelled';

    public function render()
    {
        // Email Reminders
        $this->tommorowAppointments();

        //Expired Appointments
        $this->appointmentExpired();

        $appointments = Appointment::where('patient_id', Auth::user()->id)
                                ->whereIn('status', ['Confirmed', 'Scheduled', 'On-going'])
                                ->orderBy('date', 'asc')
                                ->paginate(10);

        return view('livewire.patient.my-appointments.appointments', [
            'appointments' => $appointments,
            'services' => Service::where('status', 1)->get(),
            'specialists' => User::where('account_status', 1)->get()
        ]);
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

                $appointment->update(['reminders_sent_at' => Carbon::now()]);
        }
    }

    public function appointmentExpired()
    {
        $expiredAppointments = Appointment::whereDate('date', '<', Carbon::today())
            ->whereIn('status', ['Scheduled', 'Confirmed'])
            // ->whereNull('expired_email_sent_at')
            ->latest()
            ->get();

        foreach ($expiredAppointments as $appointment) {
            Mail::to($appointment->patient->email)
                ->send(new AppointmentExpired($appointment));

            // Update appointment status to "Cancelled"
            $appointment->update([
                'status' => 'Cancelled',
                // 'expired_email_sent_at' => Carbon::now()
            ]);
        }
    }

    // public function mount()
    // {
    //     $tomorrowAppointments = Appointment::whereDate('date', Carbon::tomorrow())
    //     ->where('status', 'Scheduled')
    //     ->where('patient_id', Auth::user()->id)
    //     ->latest()
    //     ->get();

    //     foreach ($tomorrowAppointments as $appointment) {
    //         Mail::to($appointment->patient->email)
    //             ->send(new AppointmentTomorrow($appointment));
    //     }
    // }

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

    public function create()
    {
        Validator::extend('not_earlier_than_today', function ($attribute, $value, $parameters, $validator) {
            $providedDate = Carbon::parse($value)->startOfDay();
            $today = Carbon::now()->startOfDay();

            return $providedDate->greaterThanOrEqualTo($today);
        });

        Validator::replacer('not_earlier_than_today', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':date', Carbon::now()->toDateString(), $message);
        });

        $this->validate([
            'specialist_id' => 'required',
            'service_id' => 'required',
            'date' => 'required|date|not_earlier_than_today',
            'time' => 'required|date_format:H:i|after:09:59|before:18:01',
        ],[
            'date.not_earlier_than_today' => 'The :attribute must be today or a future date.',
        ]);

        $appointmentsCount = Appointment::where('date', $this->date)->count();

        // Check if the limit of 6 appointments for the day has been reached
        if ($appointmentsCount >= 6) {
            $this->addError('date', 'The maximum number of appointments for this date has been reached.');
            return;
        }

        $appointment = Appointment::create([
            'first_name' => Auth::user()->first_name,
            'middle_name' => Auth::user()->middle_name,
            'last_name' => Auth::user()->last_name,
            'service_id' => $this->service_id,
            'specialist_id' => $this->specialist_id,
            'patient_id' => Auth::user()->id,
            'date' => $this->date,
            'time' => $this->time,
            'setting' => $this->setting,
            'status' => $this->status,
        ]);

        // Send email to the patient
        Mail::to(Auth::user()->email)->send(new AppointmentCreated($appointment));

        $this->dispatch('created');
        $this->modalAdd = false;
        $this->resetFields();
    }

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->appointment_id = $id;

        $appointment_id = Appointment::where('id', $id)->first();

        $this->first_name = $appointment_id->first_name;
        $this->middle_name = $appointment_id->middle_name;
        $this->last_name = $appointment_id->last_name;
        $this->service_id = $appointment_id->service_id;
        $this->specialist_id = $appointment_id->specialist_id;
        $this->date = $appointment_id->date;
        $this->time = $appointment_id->time;
    }

    public function update()
    {
        Validator::extend('not_earlier_than_today', function ($attribute, $value, $parameters, $validator) {
            $providedDate = Carbon::parse($value)->startOfDay();
            $today = Carbon::now()->startOfDay();

            return $providedDate->greaterThanOrEqualTo($today);
        });

        Validator::replacer('not_earlier_than_today', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':date', Carbon::now()->toDateString(), $message);
        });

        $this->validate([
            'specialist_id' => 'required',
            'service_id' => 'required',
            'date' => 'required|date|not_earlier_than_today',
            'time' => 'required|after:09:59|before:18:01',
        ],[
            'date.not_earlier_than_today' => 'The :attribute must be today or a future date.',
        ]);

        $appointmentsCount = Appointment::where('date', $this->date)->count();

        // Check if the limit of 6 appointments for the day has been reached
        if ($appointmentsCount >= 6) {
            $this->addError('date', 'The maximum number of appointments for this date has been reached.');
            return;
        }

        $updateAppointment = Appointment::where('id', $this->appointment_id);

        $updateAppointment->update([
            // 'first_name' => strtoupper($this->first_name),
            // 'middle_name' => strtoupper($this->middle_name),
            // 'last_name' => strtoupper($this->last_name),
            'service_id' => $this->service_id,
            'specialist_id' => $this->specialist_id,
            'date' => $this->date,
            'time' => $this->time,
            'status' => $this->status
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->appointment_id = $id;
    }

    public function cancel()
    {
        $updateStatus = Appointment::where('id', $this->appointment_id);

        $updateStatus->update([
            'status' => $this->cancelStatus
        ]);

        $this->resetFields();
        $this->dispatch('cancelled');
    }
}
