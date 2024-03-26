<?php

namespace App\Livewire\Doctor\Appointments;

use App\Mail\AppointmentEdited;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ViewAppointments extends Component
{
    #[URL]
    public $appointment_id;

    public $app_id;
    public $patient_name;
    public $date;
    public $time;
    public $service_name;
    public $specialist;
    public $service_id;
    public $status;
    public $appointment_date;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;

    public $patient_id;
    public $first_name;
    public $middle_name;
    public $last_name;
    public $serve_id;
    public $serve_name;
    public $specialist_name;
    public $full_name;
    public $specialist_id;
    public $app_date;
    public $app_time;
    public $setting = 'On-Site';
    public $app_status = 'Confirmed';
    
    public function render()
    {
        $appointment = Appointment::where('id', $this->appointment_id)->first();

        $this->app_id = $appointment->id;
        $this->patient_name = $appointment->patient->first_name . " " . $appointment->patient->last_name;
        $this->date = $appointment->date;
        $this->time = $appointment->time;
        $this->service_name = $appointment->service->service_name;
        $this->service_id = $appointment->service_id;
        $this->specialist = $appointment->specialist->first_name . " " . $appointment->specialist->last_name;
        $this->status = $appointment->status;
        $this->appointment_date = $appointment->date;

        return view('livewire.doctor.appointments.view-appointments', [
            'services' => Service::where('status', 1)->get(),
            'specialists' => User::where('account_status', 1)->get()
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
        // $this->reset();
        $this->resetValidation();
    }

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->appointment_id = $id;

        $appointment_id = Appointment::where('id', $id)->first();

        $this->first_name = $appointment_id->first_name;
        $this->middle_name = $appointment_id->middle_name;
        $this->last_name = $appointment_id->last_name;
        $this->serve_id = $appointment_id->service_id;
        $this->specialist_id = $appointment_id->specialist_id;
        $this->app_date = $appointment_id->date;
        $this->app_time = $appointment_id->time;
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
            'first_name' => 'required',
            'last_name' => 'required',
            'specialist_id' => 'required',
            'service_id' => 'required',
            'app_date' => 'required|date|not_earlier_than_today',
            'app_time' => 'required|after:09:59|before:18:01',
        ],[
            'date.not_earlier_than_today' => 'The :attribute must be today or a future date.',
        ]);

        $updateAppointment = Appointment::where('id', $this->appointment_id)->first();

        $updateAppointment->update([
            'first_name' => strtoupper($this->first_name),
            'middle_name' => strtoupper($this->middle_name),
            'last_name' => strtoupper($this->last_name),
            'service_id' => $this->service_id,
            'specialist_id' => $this->specialist_id,
            'date' => $this->app_date,
            'time' => $this->app_time,
            'status' => $this->app_status   
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'APPOINTMENTS',
            'user_type' => 'DOCTOR',
            'description' => 'UPDATED APPOINTMENTS'
        ]);

        Mail::to($updateAppointment->patient->email)
        ->send(new AppointmentEdited($updateAppointment));

        $this->closeModal();
        $this->resetFields();
        $this->dispatch('updated-appointment');
    }

    public function startSession()
    {
        $updateAppointment = Appointment::where('id', $this->appointment_id)->first();

        $updateAppointment->update([  
            'status' => 'On-going'   
        ]);

        $this->dispatch('updated-appointment');
    }
}
