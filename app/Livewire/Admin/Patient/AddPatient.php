<?php

namespace App\Livewire\Admin\Patient;

use App\Models\AuditTrail;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddPatient extends Component
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
        return view('livewire.admin.patient.add-patient');
    }

    public function createPatient()
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
            'emailaddress' => 'required|email|unique:users,email',
            'skintype' => 'required'        
        ]);

        // Store Patient
        User::create([
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
            'email' => $this->emailaddress,
            'skin_type' => strtoupper($this->skintype),
            'name' =>  strtoupper($this->firstname . " " . $this->middlename . " " . $this->lastname),
            'role' => 0
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'PATIENT',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'ADDED PATIENT'
        ]);

        // return $this->redirect('/manage-patient');

        Session::flash('created', 'Added Successfully.');

        $this->redirectRoute('manage-patients');
    }
}
