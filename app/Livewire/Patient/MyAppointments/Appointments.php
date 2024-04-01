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
use App\Models\AuditTrail;
use App\Models\ClinicNotif;
use App\Models\PatientNotif;
use App\Models\Schedule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
       // Fetch the latest schedule
        $latestSchedule = Schedule::latest()->first();

        // Validate inputs
        $this->validate([
            'specialist_id' => 'required',
            'service_id' => 'required',
            'date' => [
                'required',
                'date',
                // Check if the selected date is not earlier than today
                function ($attribute, $value, $fail) {
                    $selectedDate = Carbon::parse($value)->startOfDay(); 
                    $today = Carbon::now()->startOfDay();

                    // Check if the selected date is not earlier than today
                    if ($selectedDate->lt($today)) {
                        $fail("The selected date must not be earlier than today.");
                    }
                },
                // Custom rule to check if the selected date matches any day in the weekly schedule
                function ($attribute, $value, $fail) use ($latestSchedule) {
                    $selectedDay = strtolower(Carbon::parse($value)->format('l'));
                
                    $weeklySchedule = array_map('strtolower', unserialize($latestSchedule->weekly_schedule));
                
                    // Check if the selected day matches any day in the weekly schedule
                    if (!in_array($selectedDay, $weeklySchedule)) {
                        $fail("The clinic is closed on your selected date.");
                    }
                },
            ],
            'time' => [
                'required',
                'date_format:H:i',
                // Check if the selected time is in weekly schdeule
                function ($attribute, $value, $fail) use ($latestSchedule) {
                    $selectedTime = Carbon::parse($value)->format('H:i'); 

                    if ($selectedTime < $latestSchedule->open_time || $selectedTime > $latestSchedule->closing_time) {
                        $fail("The clinic is closed at your selected time");
                    }
                },
                // Check for overlapping appointments within the same hour
                function ($attribute, $value, $fail) use ($latestSchedule) {
                    $selectedTime = Carbon::parse($value); 
                    $startHour = $selectedTime->copy()->startOfHour(); 
                    $endHour = $selectedTime->copy()->endOfHour(); 
                
                    // Check if there are any existing appointments within the same hour range
                    $existingAppointments = Appointment::where('date', $this->date)
                        ->where(function ($query) use ($startHour, $endHour) {
                            $query->whereBetween('time', [$startHour, $endHour])
                                ->orWhereBetween('time', [$startHour->addMinute(), $endHour->subMinute()]);
                        })
                        ->count();
                
                    if ($existingAppointments > 0) {
                        $fail("There is already an appointment scheduled within this hour.");
                    }
                },
            ],
        ],[
            'date.not_earlier_than_today' => 'The :attribute must be today or a future date.',
            'time.after_or_equal' => 'The :attribute must be after or equal to the opening time of the clinic.',
            'time.before_or_equal' => 'The :attribute must be before or equal to the closing time of the clinic.',
        ]);

        $appointmentsCount = Appointment::where('date', $this->date)->count();

        // Check if the limit of 6 appointments for the day has been reached
        // if ($appointmentsCount >= 6) {
        //     $this->addError('date', 'The maximum number of appointments for this date has been reached.');
        //     return;
        // }

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

        // Notification
        ClinicNotif::create([
            'user_id' => Auth::user()->id,
            'description' => Auth::user()->first_name . " " . Auth::user()->last_name . " " . 'scheduled an appointment.',
            'type' => 'patient'
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
        // Fetch the latest schedule
        $latestSchedule = Schedule::latest()->first();

        $this->validate([
            'specialist_id' => 'required',
            'service_id' => 'required',
            'date' => [
                'required',
                'date',
                // Check if the selected date is not earlier than today
                function ($attribute, $value, $fail) {
                    $selectedDate = Carbon::parse($value)->startOfDay(); 
                    $today = Carbon::now()->startOfDay(); 

                    if ($selectedDate->lt($today)) {
                        $fail("The selected date must not be earlier than today.");
                    }
                },
                // Check if the selected date matches any day in the weekly schedule
                function ($attribute, $value, $fail) use ($latestSchedule) {
                    $selectedDay = strtolower(Carbon::parse($value)->format('l')); 
                
                    $weeklySchedule = array_map('strtolower', unserialize($latestSchedule->weekly_schedule));
                
                    if (!in_array($selectedDay, $weeklySchedule)) {
                        $fail("The clinic is closed on your selected date.");
                    }
                },
            ],
            'time' => [
                'required',
                'date_format:H:i',
                // Check if the selected tiem is in schedule
                function ($attribute, $value, $fail) use ($latestSchedule) {
                    $selectedTime = Carbon::parse($value)->format('H:i'); // Get the time of the selected date

                    if ($selectedTime < $latestSchedule->open_time || $selectedTime > $latestSchedule->closing_time) {
                        $fail("The clinic is closed at your selected time");
                    }
                },

                // Check for overlapping appointments within the same hour
                function ($attribute, $value, $fail) use ($latestSchedule) {
                    $selectedTime = Carbon::parse($value); 
                    $startHour = $selectedTime->copy()->startOfHour(); 
                    $endHour = $selectedTime->copy()->endOfHour(); 
                
                    // Check if there are any existing appointments within the same hour range
                    $existingAppointments = Appointment::where('date', $this->date)
                        ->where(function ($query) use ($startHour, $endHour) {
                            $query->whereBetween('time', [$startHour, $endHour])
                                ->orWhereBetween('time', [$startHour->addMinute(), $endHour->subMinute()]);
                        })
                        ->count();
                
                    if ($existingAppointments > 0) {
                        $fail("There is already an appointment scheduled within this hour.");
                    }
                },
            ],
        ],[
            'date.not_earlier_than_today' => 'The :attribute must be today or a future date.',
            'time.after_or_equal' => 'The :attribute must be after or equal to the opening time of the clinic.',
            'time.before_or_equal' => 'The :attribute must be before or equal to the closing time of the clinic.',
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
        ]);

        // Notification
        ClinicNotif::create([
            'user_id' => Auth::user()->id,
            'description' => Auth::user()->first_name . " " . Auth::user()->last_name . " " . 'Re-scheduled an appointment.',
            'type' => 'patient'
        ]);

         // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'APPOINTMENT',
            'user_type' => 'PATIENT',
            'description' => ' RE-SCHEDULED AN APPOINTMENT'
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

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'APPOINTMENT',
            'user_type' => 'PATIENT',
            'description' => 'CANCELLED AN APPOINTMENT'
        ]);
    }
}
