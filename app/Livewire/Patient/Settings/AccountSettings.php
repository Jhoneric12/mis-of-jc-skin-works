<?php

namespace App\Livewire\Patient\Settings;

use App\Models\AuditTrail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AccountSettings extends Component
{
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
        $patient = User::where('id', Auth::user()->id)->first();

        $this->firstname = $patient->first_name;
        $this->middlename = $patient->middle_name;
        $this->lastname = $patient->last_name;
        $this->bDate = $patient->birth_date;
        $this->age = $patient->age;
        $this->gender = $patient->gender;
        $this->civilstatus = $patient->civil_status;
        $this->religion = $patient->religion;
        $this->homeaddress = $patient->home_address;
        $this->contactnumber = $patient->contact_number;
        $this->emailaddress = $patient->email;
        $this->skintype = $patient->skin_type;

        return view('livewire.patient.settings.account-settings');
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

        $updatePatient = User::where('id', Auth::user()->id)->first();

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
            'log_name' => 'SETTINGS',
            'user_type' => 'PATIENT',
            'description' => 'UPDATED PROFILE'
        ]);
        
        $this->dispatch('updated');

    }
}
