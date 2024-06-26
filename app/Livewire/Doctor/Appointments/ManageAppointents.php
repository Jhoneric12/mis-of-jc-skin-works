<?php

namespace App\Livewire\Doctor\Appointments;

ini_set('max_execution_time', 18000);

use App\Mail\AppointmentCanceled;
use App\Mail\AppointmentCreated;
use App\Mail\AppointmentEdited;
use Livewire\Component;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

use Barryvdh\DomPDF\Facade\Pdf;

class ManageAppointents extends Component
{
    use WithPagination;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $search = '';
    public $filter = 'All';
    public $isOnline = 'All';

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
        $appointments = Appointment::query()
        ->where('specialist_id', Auth::user()->id)
        ->whereIn('status', ['Confirmed', 'Completed','Cancelled', 'On-going'])
        // ->where('id', Auth::user()->id)
        ->where(function ($query) {
            $query->where('id', $this->search)
                  ->orWhere('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%')
                  ->orWhere('status', $this->search)
                  ->orWhere('id', $this->search);
        })
        ->when($this->filter !== 'All', function ($query) {
            $query->where('status', $this->filter);
        })
        ->when($this->isOnline !== 'All', function ($query) {
            $query->where('setting', $this->isOnline);
        })  
        ->latest()
        ->paginate(10);

        $appointments_today = Appointment::where('specialist_id', Auth::user()->id)
            ->whereDate('date', Carbon::now()->toDateString())->count();

        $confirmed = Appointment::where('status', 'Confirmed')->where('specialist_id', Auth::user()->id)->count();
        $cancelled = Appointment::where('status', 'Cancelled')->where('specialist_id', Auth::user()->id)->count();
        $completed = Appointment::where('status', 'Completed')->where('specialist_id', Auth::user()->id)->count();
        $onGoing = Appointment::where('status', 'On-Going')->where('specialist_id', Auth::user()->id)->count();

        return view('livewire.doctor.appointments.manage-appointents', [
            'confirmed' => $confirmed,
            'cancelled' => $cancelled,
            'completed' => $completed,
            'ongoing' => $onGoing,
            'appointments_today' => $appointments_today,
            'appointments' => $appointments,
            'services' => Service::where('status', 1)->get(),
            'specialists' => User::where('account_status', 1)->get(),
            'patients' => User::where("role", 0)->get()
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

        $patient = User::where('id', $this->patient_id)->first();

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
            'log_name' => 'APPOINTMENTS',
            'user_type' => 'DOCTOR',
            'description' => 'ADDED APPOINTMENTS'
        ]);

        Mail::to($patient->email)
        ->send(new AppointmentCreated($appointment));

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

        $updateAppointment = Appointment::where('id', $this->appointment_id)->first();

        if ($updateAppointment->status == 'On-going')
        {
            $this->status = 'On-going';
        }
        elseif ($updateAppointment->status == 'Confirmed')
        {
            $this->status = 'Confirmed';
        }
        elseif ($updateAppointment->status == 'Cancelled')
        {
            $this->status = 'Confirmed';
        }

        $updateAppointment->update([
            'first_name' => strtoupper($this->first_name),
            'middle_name' => strtoupper($this->middle_name),
            'last_name' => strtoupper($this->last_name),
            'service_id' => $this->service_id,
            'specialist_id' => $this->specialist_id,
            'date' => $this->date,
            'time' => $this->time,
            'status' => $this->status
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

        $this->resetFields();
        $this->dispatch('updated-appointment');
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->appointment_id = $id;

        $appointment_id = Appointment::where('id', $id)->first();

        $this->appointment_id = $appointment_id->id;
    }

    public function updateStatus($id)
    {
        $updateStatus = Appointment::where('id', $id)->first();

        $patient_email = $updateStatus->patient->email;

        $updateStatus->update([
            'status' => 'Cancelled'
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'APPOINTMENTS',
            'user_type' => 'DOCTOR',
            'description' => 'CANCELLED APPOINTMENTS'
        ]);

        Mail::to($patient_email)->send(new AppointmentCanceled($updateStatus));

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function view($id)
    {
        $this->modalView = true;

        $this->appointment_id = $id;

        $appointment_id = Appointment::where('id', $id)->first();

        $this->full_name = $appointment_id->first_name . " " . $appointment_id->last_name;
        $this->service_name = $appointment_id->service->service_name;
        $this->specialist_name = $appointment_id->specialist->first_name . " " . $appointment_id->specialist->last_name;
        $this->date = $appointment_id->date;
        $this->time = $appointment_id->time;
        $this->status = $appointment_id->status;
    }

    public function export()
    {
        $data = Appointment::where('specialist_id', Auth::user()->id)->latest()->get();
        $pdf = PDF::loadView('Admin.Dompdf.Appointment.appointment-report', ['data' => $data]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="appointment_list_report.pdf"',
        ];

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'APPOINTMENT',
            'user_type' => 'DOCTOR',
            'description' => 'EXPORTED APPOINTMENT'
        ]);

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
