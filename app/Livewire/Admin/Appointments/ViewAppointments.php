<?php

namespace App\Livewire\Admin\Appointments;

use App\Mail\AppointmentEdited;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Schedule;
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

        return view('livewire.admin.appointments.view-appointments', [
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

    private function validateDateNotEarlierThanToday($attribute, $value, $fail) {
        $selectedDate = Carbon::parse($value)->startOfDay(); 
        $today = Carbon::now()->startOfDay();
    
        // Check if the selected date is not earlier than today
        if ($selectedDate->lt($today)) {
            $fail("The selected date must not be earlier than today.");
        }
    }
    
    private function validateTimeWithinWeeklySchedule($attribute, $value, $fail, $latestSchedule) {
        $selectedTime = Carbon::parse($value)->format('H:i'); 
    
        if ($selectedTime < $latestSchedule->open_time || $selectedTime > $latestSchedule->closing_time) {
            $fail("The clinic is closed at your selected time");
        }
    }
    
    private function validateNoOverlappingAppointments($attribute, $value, $fail, $date) {
        $selectedTime = Carbon::parse($value); 
    
        // Calculate the start and end of the selected hour
        $startHour = $selectedTime->copy()->startOfHour(); 
        $endHour = $selectedTime->copy()->endOfHour(); 
    
        // Check if there are any existing appointments within the same hour
        $existingAppointments = Appointment::where('date', $date)
            ->whereBetween('time', [$startHour, $endHour])
            ->count();
    
        if ($existingAppointments > 0) {
            $fail("This time is not available.");
        }
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
        // Fetch the latest schedule
        $latestSchedule = Schedule::latest()->first();

        // Validate inputs
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'specialist_id' => 'required',
            'service_id' => 'required',
            'app_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $this->validateDateNotEarlierThanToday($attribute, $value, $fail);
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
            'app_time' => [
                'required',
                'date_format:H:i',
                // Check if the selected time is in weekly schedule
                function ($attribute, $value, $fail) use ($latestSchedule) {
                    $this->validateTimeWithinWeeklySchedule($attribute, $value, $fail, $latestSchedule);
                },
                // Check for overlapping appointments within the same hour
                function ($attribute, $value, $fail) {
                    $this->validateNoOverlappingAppointments($attribute, $value, $fail, $this->date);
                },
            ],
        ],[
            'app_date.not_earlier_than_today' => 'The :attribute must be today or a future date.',
            'app_time.after_or_equal' => 'The :attribute must be after or equal to the opening time of the clinic.',
            'app_time.before_or_equal' => 'The :attribute must be before or equal to the closing time of the clinic.',
        ]);

        $updateAppointment = Appointment::where('id', $this->appointment_id)->first();

        if ($updateAppointment->status == 'On-going')
        {
            $this->app_status = 'On-going';
        }
        elseif ($updateAppointment->status == 'Confirmed')
        {
            $this->app_status = 'Confirmed';
        }
        elseif ($updateAppointment->status == 'Cancelled')
        {
            $this->app_status = 'Confirmed';
        }

        $updateAppointment->update([
            'first_name' => strtoupper($this->first_name),
            'middle_name' => strtoupper($this->middle_name),
            'last_name' => strtoupper($this->last_name),
            'service_id' => $this->serve_id,
            'specialist_id' => $this->specialist_id,
            'date' => $this->app_date,
            'time' => $this->app_time,
            'status' => $this->app_status
        ]);

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'APPOINTMENTS',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED APPOINTMENT'
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

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'SESSION',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'STARTED A SESSION'
        ]);
    }

}
