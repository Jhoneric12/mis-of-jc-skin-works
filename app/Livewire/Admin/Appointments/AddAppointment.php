<?php

namespace App\Livewire\Admin\Appointments;

use App\Mail\AppointmentCreated;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
    public $status = 'Scheduled';

    public function render()
    {
        return view('livewire.admin.appointments.add-appointment',[
            'services' => Service::where('status', 1)->get(),
            'specialists' => User::where('account_status', 1)->get()
        ]);
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
        'patient_id' => 'required|exists:users,id',
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
            'patient_id.exists' => 'Patient id not found'
        ]);

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

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'APPOINTMENT',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'SCHEDULED AN APPOINTMENT'
        ]);


        Mail::to($patient->email)
        ->send(new AppointmentCreated($appointment));

        Session::flash('created', 'Added Successfully.');

        $this->redirectRoute('appointment-calendar');
    }
}
