<?php

namespace App\Livewire\Admin\Settings\Accounts;

use App\Models\AuditTrail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Patient extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'All';
    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;

    // Patient Fields
    public $first_name;
    public $middle_name;
    public $last_name;
    public $full_name;
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
    public $image;
    public $username;
    public $password;
    public $password_confirmation;
    public $status;
     
    public function render()
    {
        $patients = User::where('role', '0')
            ->whereNotNull('username')
            ->where(function ($query) {
                $query->where('username', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('first_name', 'like', '%' . $this->search . '%')
                      ->orWhere('middle_name', 'like', '%' . $this->search . '%')
                      ->orWhere('last_name', 'like', '%' . $this->search . '%')
                      ->orWhere('id', $this->search);
            })
            ->when($this->filter !== 'All', function ($query) {
                $query->where('account_status', $this->filter === 'Active');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('livewire.admin.settings.accounts.patient', ['patients' => $patients]);
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
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        User::create([
            'first_name' => strtoupper($this->first_name),
            'middle_name' => strtoupper($this->middle_name),
            'last_name' => strtoupper($this->last_name),
            'email' => $this->email,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'name' => strtoupper($this->first_name . " " . $this->middle_name . " " . $this->last_name)
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'ACCOUNT',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'ADDED PATIENT ACCOUNT'
        ]);

        $this->modalAdd = false;
        $this->resetFields();
        $this->dispatch('created');
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->patient_id = $id;

        $patient_id = User::where('id', $id)->first();

        $this->patient_id = $patient_id->id;
    }

    public function updateStatus()
    {
        $this->validate(['status' => 'required']);
        
        $updateStatus = User::where('id', $this->patient_id);
        
        $status = $this->status == 'Active' ? 1 : 0;

        $updateStatus->update([
            'account_status' => $status
        ]);

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'ACCOUNT',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'UPDATED PATIENT ACCOUNT STATUS'
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function view($id)
    {
        $this->modalView = true;

        $this->patient_id = $id;

        $patient_id = User::where('id', $id)->first();

        $this->full_name = $patient_id->first_name . " " . $patient_id->last_name;
        $this->email = $patient_id->email;
        $this->username = $patient_id->username;
        $this->status = $patient_id->status;
        $this->image = $patient_id->profile_photo_url;
    }
}
