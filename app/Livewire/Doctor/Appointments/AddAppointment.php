<?php

namespace App\Livewire\Doctor\Appointments;

use Livewire\Component;
use App\Mail\AppointmentCreated;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AddAppointment extends Component
{
    public $appointment_id;
    public $patient_id;
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
    public $setting = 'On-Site';
    public $status = 'Confirmed';

    public function render()
    {
        return view('livewire.doctor.appointments.add-appointment',[
            'services' => Service::where('status', 1)->get(),
            'specialists' => User::where('account_status', 1)->get()
        ]);
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
            'patient_id' => 'required',
            // 'first_name' => 'required',
            // 'last_name' => 'required',
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

        $patient = User::where('id',$this->patient_id)->first();

        $appointment = Appointment::create([
            'patient_id' => $this->patient_id,
            'first_name' => $patient->first_name,
            'middle_name' => $patient->middle_name,
            'last_name' => $patient->last_name,
            'service_id' => $this->service_id,
            'specialist_id' => $this->specialist_id,
            'date' => $this->date,
            'time' => $this->time,
            'setting' => $this->setting,
            'status' => $this->status,
        ]);

        Mail::to($patient->email)
        ->send(new AppointmentCreated($appointment));

        Session::flash('created', 'Added Successfully.');

        $this->redirectRoute('doctor-appointment-calendar');
    }
}
