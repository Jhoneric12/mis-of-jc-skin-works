<?php

namespace App\Livewire\Admin\Dashboard;

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
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

    public $sales;
    public $servicesSales;
    public $productsSales;
    public $weeklySales;
    public $dailySales;
    public $dailyVisitsData;

    public function render()
    {
        $appointments = Appointment::whereIn('status', ['Scheduled', 'Completed', 'Cancelled', 'Confirmed'])
                        ->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                        ->latest()->paginate(5);

        $total_patient = User::where('role', 0)->count();

        $appointments_today = Appointment::whereDate('date', '=',  Carbon::today()->toDateString())
            ->whereIn('status', ['Confirmed', 'On-going', 'Cancelled', 'Completed'])
            ->latest()
            ->paginate(5);
        
        $pending_appointments = Appointment::where('status', 'Scheduled')
            ->orderBy('date', 'asc')
            ->get();

        // Top 3 selling products
        $topSellingProducts = OrderItem::selectRaw('item_id, SUM(quantity) as total_quantity')
            ->groupBy('item_id')
            ->orderByDesc('total_quantity')
            ->limit(3)
            ->get();

       // Get the current month's start and end dates
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        // Calculate the monthly revenue
        $total_sales = Orders::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->sum('total_amount');

        $total_products = Product::count();

        $critical_products = Product::whereColumn('total_qty', '<', 'min_qty')->where('status', 1)->count();

        return view('livewire.admin.dashboard.dashboard', compact('total_patient', 'total_sales', 'total_products', 'critical_products', 'appointments_today', 'appointments', 'topSellingProducts', 'pending_appointments'));
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
                    'type' => 'admin'
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
                    'type' => 'admin'
                ]);
            }
        }

        // Fetch and aggregate sales data by month
        $this->sales = Orders::selectRaw('SUM(total_amount) as total, DATE_FORMAT(created_at, "%Y-%m") as month')
                            ->groupBy('month')
                            ->orderBy('month')
                            ->get();

        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        $this->weeklySales = Orders::selectRaw('SUM(total_amount) as total, YEARWEEK(created_at, 1) as week')
                            ->groupBy('week')
                            ->orderBy('week')
                            ->pluck('total', 'week')
                            ->toArray();

        $this->dailySales = Orders::selectRaw('SUM(total_amount) as total, DATE(created_at) as day')
                            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                            ->groupBy('day')
                            ->orderBy('day')
                            ->pluck('total', 'day')
                            ->toArray();
        

         // Fetch sales data for services
         $this->servicesSales = OrderItem::where('item_type', 'Service')->sum('price');

         // Fetch sales data for products
         $this->productsSales = OrderItem::where('item_type', 'Product')->sum('price');

         // Fetch daily visits data from the database
        $this->dailyVisitsData = Appointment::selectRaw('DATE(date) as visit_date, COUNT(*) as visit_count')
        ->groupBy('visit_date')
        ->get()
        ->pluck('visit_count', 'visit_date');
        
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
