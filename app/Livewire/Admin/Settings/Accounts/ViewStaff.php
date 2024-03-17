<?php

namespace App\Livewire\Admin\Settings\Accounts;

use App\Models\Appointment;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Url;

class ViewStaff extends Component
{
    #[Url]
    public $staff_id;

    public $license_number;

    public $modalUpdate = false;

    public $full_name;

    public function render()
    {
        $staff = User::where('id', $this->staff_id)->first();

        $appointments = Appointment::where('specialist_id', $this->staff_id)
                                    ->whereDate('date', '=',  Carbon::today()->toDateString())->paginate(3);

        return view('livewire.admin.settings.accounts.view-staff', [
            'staff' => $staff,
            'appointments' => $appointments
        ]);
    }

    public function editLicense()
    {
        $this->modalUpdate = true;

        $license = User::where('id', $this->staff_id)->first();

        $this->license_number = $license->license_number;

        $this->full_name = $license->first_name . " " . $license->last_name;
    }

    public function updateLicense()
    {
        $updateLicense = User::where('id', $this->staff_id)->first();

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
