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
use App\Models\Schedule;
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
            'time' => [
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
            'date.not_earlier_than_today' => 'The :attribute must be today or a future date.',
            'time.after_or_equal' => 'The :attribute must be after or equal to the opening time of the clinic.',
            'time.before_or_equal' => 'The :attribute must be before or equal to the closing time of the clinic.',
        ]);

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
