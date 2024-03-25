<?php

namespace App\Livewire\Staff\Appointments;

use Livewire\Component;
use App\Mail\AppointmentCanceled;
use App\Mail\AppointmentCreated;
use App\Mail\AppointmentEdited;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ManageAppointments extends Component
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

        return view('livewire.staff.appointments.manage-appointments', [
            'confirmed' => $confirmed,
            'cancelled' => $cancelled,
            'completed' => $completed,
            'ongoing' => $onGoing,
            'appointments_today' => $appointments_today,
            'appointments' => $appointments,
            'services' => Service::all(),
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
            // 'specialist_id' => 'required',
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

        $patient = User::where('id', $this->patient_id)->first();

        $appointment = Appointment::create([
            'patient_id' => $this->patient_id,
            'first_name' => $patient->first_name,
            'middle_name' => $patient->middle_name,
            'last_name' => $patient->last_name,
            'service_id' => $this->service_id,
            'specialist_id' => Auth::user()->id,
            'date' => $this->date,
            'time' => $this->time,
            'setting' => $this->setting,
            'status' => $this->status,
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
            'date' => 'required|date|not_earlier_than_today',
            'time' => 'required|after:09:59|before:18:01',
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
            'date' => $this->date,
            'time' => $this->time,
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
}
