<?php

namespace App\Livewire\Staff\Dashboard;

use Livewire\Component;
use App\Models\User;
use App\Models\Product;
use App\Models\Orders;
use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentConfirmed;
use App\Mail\AppointmentDeclined;
use App\Models\ClinicNotif;
use App\Models\Inventory;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $search;
    public $filter;
    public $isOnline;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $appointment_id;
    public $status;

    public function render()
    {

        $appointments = Appointment::where('status', 'Scheduled')
                        ->where('specialist_id', Auth::id())
                        ->orderBy('date', 'asc')
                        ->get();

        $appointments_today = Appointment::where('specialist_id', Auth::user()->id)
            ->whereIn('status', ['Confirmed', 'On-going', 'Cancelled', 'Completed'])
            ->whereDate('date', '=',  Carbon::today()->toDateString())
            ->latest()
            ->paginate(10);

        $appointments_today_count = $appointments_today->count();

        $todays_sales = Orders::whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->sum('total_amount');

        $total_patient = User::where('role', 0)->count();

       // Get the current month's start and end dates
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the monthly revenue
        $total_sales = Orders::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->sum('total_amount');

        $total_products = Product::count();

        $critical_products = Product::whereColumn('total_qty', '<', 'min_qty')->count();

        $treated_patients = Appointment::where('status', 'Completed')->where('specialist_id', Auth::user()->id)->count();

        return view('livewire.staff.dashboard.dashboard', compact('appointments_today', 'total_patient', 'total_sales', 'total_products', 'critical_products', 'appointments', 'treated_patients', 'appointments_today_count', 'todays_sales'));
    }

    public function mount()
    {
        $critical_products = Product::whereColumn('total_qty', '<', 'min_qty')
            ->where('status', 1)
            ->get();

        foreach ($critical_products as $product) {
            $existing_notification = ClinicNotif::where('user_id', Auth::user()->id)
                                                ->where('description', 'like', '%'.$product->product_name.'%')
                                                ->exists();
            
            if (!$existing_notification) {
                ClinicNotif::create([
                    'user_id' => Auth::user()->id,
                    'description' => 'Product "'.$product->product_name.'" is in low stock. Manage the product before the stock reaches zero',
                    'type' => 'staff'
                ]);
            }
        }

        // Check for expiring items
        $expiring_items = Inventory::where('expiration_date', '<=', now()->addMonth())
                                    ->get();

                foreach ($expiring_items as $item) {
                $existing_notification = ClinicNotif::where('user_id', Auth::user()->id)
                            ->where('description', 'like', '%'.$item->product->product_name.'%')
                            ->exists();

                if (!$existing_notification) {
                    ClinicNotif::create([
                    'user_id' => Auth::user()->id,
                    'description' => 'Product "'.$item->product->product_name.'" is expiring soon. Manage the product before it expires.',
                    'type' => 'staff'
                ]);
            }
        }
    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->appointment_id = $id;

        $appointment_id = Appointment::where('id', $id)->first();

        $this->appointment_id = $appointment_id->id;
    }

    public function updateStatus()
    {
        $updateStatus = Appointment::where('id', $this->appointment_id);

        $this->validate(['status' => 'required']);

        $updateStatus->update([
            'status' => $this->status
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function confirm($id)
    {
        $updateStatus = Appointment::where('id', $id)->first();

        $updateStatus->update([
            'status' => 'Confirmed'
        ]);

        // Send confirmation email to the patient
        Mail::to($updateStatus->patient->email)->send(new AppointmentConfirmed($updateStatus));

        $this->dispatch('confirmed');

    }

    public function cancel($id)
    {
        $updateStatus = Appointment::where('id', $id)->first();

        $updateStatus->update([
            'status' => 'Cancelled'
        ]);

        // Send confirmation email to the patient
        Mail::to($updateStatus->patient->email)->send(new AppointmentDeclined($updateStatus));

        $this->dispatch('cancelled');
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
}
