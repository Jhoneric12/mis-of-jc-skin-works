<?php

namespace App\Livewire\Admin\Settings\Accounts;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Url;

class ViewDoctor extends Component
{
    #[Url]
    public $doctor_id;

    public $license_number;

    public $modalUpdate = false;

    public function render()
    {   
        $doctor = User::where('id', $this->doctor_id)->first();

        $appointments = Appointment::where('specialist_id', $this->doctor_id)
                                    ->whereDate('date', '=',  Carbon::today()->toDateString())->paginate(3);

        return view('livewire.admin.settings.accounts.view-doctor', [
            'staff' => $doctor,
            'appointments' => $appointments
        ]);
    }

    public function editLicense()
    {
        $this->modalUpdate = true;

        $license = User::where('id', $this->doctor_id)->first();

        $this->license_number = $license->license_number;
    }

    public function updateLicense()
    {
        $updateLicense = User::where('id', $this->doctor_id)->first();

        $updateLicense->update([
            'license_number' => $this->license_number
        ]);

        $this->modalUpdate = false;
        $this->dispatch('updated');
    }

    public function closeModal()
    {
        $this->modalUpdate = false;
    }
}
