<?php

namespace App\Livewire\Doctor\Transactions;

use App\Models\Orders;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Transactions extends Component
{
    use WithPagination;

    public $search = '';
    public $startDate = '';
    public $endDate = '';
    public $payment_mode = 'All';

    public function render()
    {
        $query = Orders::query()
        ->where('staff_id', Auth::user()->id)
        ->where(function ($query) {
            $query->where('patient_id', $this->search)
                  ->orWhere('patient_name', 'like', '%' . $this->search . '%');
        })

        ->when($this->payment_mode !== 'All', function ($query) {
            $query->where('payment_mode', $this->payment_mode);
        })

        ->latest();

        if (!empty($this->startDate) && !empty($this->endDate)) {
            $startDate = Carbon::parse($this->startDate)->startOfDay();
            $endDate = Carbon::parse($this->endDate)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $transactions = $query->paginate(10);

        return view('livewire.doctor.transactions.transactions', ['transactions' => $transactions]);
    }

    public function filterByDate()
    {
        $this->resetPage();
    }
}
