<?php

namespace App\Livewire\Admin\Patient;

use App\Models\AuditTrail;
use Livewire\Component;
use Livewire\Attributes\Url;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UpdatePatient extends Component
{
    #[URL]
    public $patient_id;

    public $firstname;
    public $middlename;
    public $lastname;
    public $bDate;
    public $age;
    public $gender;
    public $civilstatus;
    public $religion;
    public $homeaddress;
    public $contactnumber;
    public $emailaddress;
    public $skintype;

    public function render()
    {
        $patient = User::where('id', $this->patient_id)->first();

        $this->firstname = $patient->first_name;
        $this->middlename = $patient->middle_name;
        $this->lastname = $patient->last_name;
        $this->bDate =  $patient->birth_date;
        $this->age = $patient->age;
        $this->gender = $patient->gender;
        $this->civilstatus = $patient->civil_status;
        $this->religion = $patient->religion;
        $this->homeaddress = $patient->home_address;
        $this->contactnumber = $patient->contact_number;
        $this->emailaddress = $patient->email;
        $this->skintype = $patient->skin_type;

        return view('livewire.admin.patient.update-patient');
    }

    public function update()
    {
        $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'bDate' => 'required|date|before:today',
            'age' => 'required|numeric|min:1',
            'gender' => 'required',
            'civilstatus' => 'required',
            'religion' => 'required',
            'homeaddress' => 'required',
            'contactnumber' => 'required',
            // 'emailaddress' => 'required|email|unique:users,email',
            'skintype' => 'required'       
        ]);

        $updatePatient = User::where('id', $this->patient_id)->first();

        $updatePatient->update([
            'first_name' => strtoupper($this->firstname),
            'middle_name' => strtoupper($this->middlename),
            'last_name' => strtoupper($this->lastname),
            'birth_date' => $this->bDate,
            'age' => $this->age,
            'gender' =>  $this->gender,
            'civil_status' =>  $this->civilstatus,
            'religion' =>strtoupper($this->religion),
            'home_address' => strtoupper($this->homeaddress),
            'contact_number' => $this->contactnumber,
            'skin_type' => strtoupper($this->skintype),
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'PATIENT',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED PATIENT'
        ]);

        Session::flash('updated', 'Updated Successfully.');

        $this->redirectRoute('manage-patients');

    }
}
