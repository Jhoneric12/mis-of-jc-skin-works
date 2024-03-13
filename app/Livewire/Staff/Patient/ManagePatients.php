<?php

namespace App\Livewire\Staff\Patient;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class ManagePatients extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'All';
    public $modalAdd = false;
    public $modalUpdate = false;

    // Patient Fields
    public $first_name;
    public $middle_name;
    public $last_name;
    public $birth_date;
    public $age;
    public $gender;
    public $civil_status;
    public $religion;
    public $home_address;
    public $contact_number;
    public $email;
    public $skin_type; 
    public $patient_id; 

    public $patient;
    
    public function render()
    {
        $patients = User::where('role', '0')
            ->where(function ($query) {
                $query->where('username', 'like', '%' . $this->search . '%')
                      ->orWhere('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('id', $this->search);
                    //   ->orWhereNotNull('gender');
            })
            ->when($this->filter !== 'All', function ($query) {
                $query->where('account_status', $this->filter === 'Active');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.staff.patient.manage-patients', ['patients' => $patients]);
    }

    public function createPatient()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required|date|before:today',
            'age' => 'required|numeric|min:1',
            'gender' => 'required',
            'civil_status' => 'required',
            'religion' => 'required',
            'home_address' => 'required',
            'contact_number' => 'required',
            'email' => 'required|email|unique:users',
            'skin_type' => 'required'        
        ]);

        User::create([
            'first_name' => strtoupper($this->first_name),
            'middle_name' => strtoupper($this->middle_name),
            'last_name' => strtoupper($this->last_name),
            'birth_date' => $this->birth_date,
            'age' => $this->age,
            'gender' => $this->gender,
            'civil_status' => $this->civil_status,
            'religion' => strtoupper($this->religion),
            'home_address' =>strtoupper( $this->home_address),
            'contact_number' => $this->contact_number,
            'email' => $this->email,
            'skin_type' => strtoupper($this->skin_type),
            'name' => strtoupper($this->first_name . " " . $this->middle_name . " " . $this->last_name)
        ]);

        $this->modalAdd = false;
        $this->reset();
        $this->resetValidation();
        $this->dispatch('patient-created');
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

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $patientId = User::where('id', $id)->first();

        $this->patient_id = $patientId->id;
        $this->first_name = $patientId->first_name;
        $this->middle_name = $patientId->middle_name;
        $this->last_name = $patientId->last_name;
        $this->birth_date = $patientId->birth_date;
        $this->age = $patientId->age;
        $this->gender = $patientId->gender;
        $this->civil_status = $patientId->civil_status;
        $this->religion = $patientId->religion;
        $this->home_address = $patientId->home_address;
        $this->contact_number = $patientId->contact_number;
        $this->email = $patientId->email;
        $this->skin_type = $patientId->skin_type;
    }
    
    public function updatePatient () 
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => 'required|date|before:today',
            'age' => 'required|numeric|min:1',
            'gender' => 'required',
            'civil_status' => 'required',
            'religion' => 'required',
            'home_address' => 'required',
            'contact_number' => 'required',
            // 'email' => 'required|email|unique:users',
            'skin_type' => 'required'        
        ]);

        $updatePatient = User::where('id', $this->patient_id)->first();

        $updatePatient->update([
            'first_name' => strtoupper($this->first_name),
            'middle_name' => strtoupper($this->middle_name),
            'last_name' => strtoupper($this->last_name),
            'birth_date' => $this->birth_date,
            'age' => $this->age,
            'gender' => $this->gender,
            'civil_status' => $this->civil_status,
            'religion' => strtoupper($this->religion),
            'home_address' =>strtoupper( $this->home_address),
            'contact_number' => $this->contact_number,
            // 'email' => $this->email,
            'skin_type' => strtoupper($this->skin_type),
            'name' => strtoupper($this->first_name . " " . $this->middle_name . " " . $this->last_name)
        ]);

       $this->resetFields();
       $this->dispatch('updated-patient');
    }
}
