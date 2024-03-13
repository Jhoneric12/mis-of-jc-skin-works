<?php

namespace App\Livewire\Staff\Settings\Accounts;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Staff extends Component
{
    public $search = '';
    public $filter = 'All';
    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;

    // Staff Fields
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
    public $staff_id;
    public $username;
    public $password;
    public $password_confirmation;
    public $status;
    public function render()
    {
        $staff = User::where('role', '2')
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
            ->paginate(5);
    
        return view('livewire.staff.settings.accounts.staff', ['staffs' => $staff]);
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
            'name' => strtoupper($this->first_name . " " . $this->middle_name . " " . $this->last_name),
            'role' => 2
        ]);

        $this->modalAdd = false;
        $this->resetFields();
        $this->dispatch('created');
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->staff_id = $id;

        $staff_id = User::where('id', $id)->first();

        $this->staff_id = $staff_id->id;
    }

    public function updateStatus()
    {
        $this->validate(['status' => 'required']);
        
        $updateStatus = User::where('id', $this->staff_id);
        
        $status = $this->status == 'Active' ? 1 : 0;

        $updateStatus->update([
            'account_status' => $status
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function view($id)
    {
        $this->modalView = true;

        $this->staff_id = $id;

        $staff_id = User::where('id', $id)->first();

        $this->full_name = $staff_id->first_name . " " . $staff_id->last_name;
        $this->email = $staff_id->email;
        $this->username = $staff_id->username;
        $this->status = $staff_id->status;
    }
}
