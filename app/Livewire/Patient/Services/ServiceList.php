<?php

namespace App\Livewire\Patient\Services;

use Livewire\Component;
use App\Models\Service;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use App\Mail\AppointmentCreated;
use App\Models\AuditTrail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class ServiceList extends Component
{
    public $modalAdd = false;
    
    public $service_id;

    public $appointment_id;
    public $first_name;
    public $middle_name;
    public $last_name;
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
        $services = Service::where('status', 1)->get();

        $specialists = User::where('role',  2)
                    ->orWhere('role', 3)->get();

        return view('livewire.patient.services.service-list', [
            'services' => $services,
            'specialists' => User::where('account_status', 1)->get()
        ]);
    }

    public function closeModal()
    {
        $this->modalAdd = false;
        $this->resetFields();
    }

    public function resetFields()
    {
        $this->reset();
        $this->resetValidation();
    }

    public function add($id)
    {
        $this->modalAdd = true;

        $this->service_id = $id;

        $service_id = Service::where('id', $id)->first();

        $this->specialist_id = $service_id->specialist_id;
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

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'APPOINTMENT',
            'user_type' => 'PATIENT',
            'description' => 'SCHEDULED AN APPOINTMENT'
        ]);
         

        // Send email to the patient
        Mail::to(Auth::user()->email)->send(new AppointmentCreated($appointment));

        $this->dispatch('created');
        $this->modalAdd = false;
        $this->resetFields();
    }
}
