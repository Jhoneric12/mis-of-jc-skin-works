<?php

namespace App\Livewire\Admin\Billing;

ini_set('max_execution_time', 18000);

use Livewire\Component;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\OrderItem;
use App\Models\Orders;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use App\Models\Appointment;
use App\Models\AuditTrail;
use App\Models\Promo;
use App\Models\Promotion;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;

class Billing extends Component
{
    public $search;
    public $serviceSearch;
    public $promoSearch;
    public $quantity = 1;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalStatus = false;
    public $modalSucess = false;

    #[URL]
    public $appointment_id;

    public $payment_mode;
    public $change = 0;
    public $total_amount;
    public $cash_rendered;
    public $patient_id;
    public $patient_name;
    public $ref_no;
    public $promo_id;
    public $discount;
    public $cartTotal;

    public $cart = [];
    protected $listeners = ['addToCart'];

    public $productPage = 1;
    public $servicePage = 1;

    public $order_no;

    public function render()
    {
        $products = [];
        $services = [];
        $promos = [];

        $this->cartTotal = number_format(array_sum(array_map(function($item) { return (float) $item['total']; }, $this->cart)), 2);
        $this->total_amount = array_sum(array_column($this->cart, 'total'));
        $this->computeDiscount();

        $latestOrderId = Orders::max('id');
        $this->order_no = $latestOrderId + 1;

        if($this->appointment_id)
        {
            $patient = Appointment::where('id', $this->appointment_id)->first();
            $this->patient_id = $patient->patient->id;
            $this->patient_name = $patient->patient->first_name . " " .  $patient->patient->middle_name . " " .   $patient->patient->last_name;
        }
        
        // Check if search property has a value
        if ($this->search) {
            $query = Inventory::query()
            ->leftJoin('products', 'inventories.product_id', '=', 'products.id')
            ->where('products.status', 1)
            ->where(function ($query) {
                $query->where('products.product_name', 'like', '%' . $this->search . '%')
                    ->orWhere('inventories.product_id', $this->search)
                    ->orWhere('product_id', $this->search);
            })
            ->orderBy('inventories.expiration_date', 'asc')
            ->orderBy('inventories.created_at', 'desc');
        
            $products = $query->get();
        
        }

        // Check if serviceSearch property has a value
        if ($this->serviceSearch) {
            // Modify service query to include pagination
            $serviceQuery = Service::query()
                ->where('service_name', 'like', '%' . $this->serviceSearch . '%')
                ->where('status', 1)
                ->orderBy('created_at', 'desc');

            // $services = $serviceQuery->paginate(3, ['*'], 'servicePage');
            $services = $serviceQuery->get();
        }

        // Check if promoSearch property has value
        if($this->promoSearch) {
             // Modify service query to include pagination
             $promosQuery = Promo::query()
             ->where('promo_name', 'like', '%' . $this->promoSearch . '%')
             ->where('status', 1)
             ->orderBy('created_at', 'desc');

            $promos = $promosQuery->get();
        }

        return view('livewire.admin.billing.billing', [
            'services' => $services,
            'products' => $products,
            'promos' => $promos,
            'categories' => ProductCategory::all(),
            'items' => Product::all(),
        ]);
    }

    public function computeDiscount()
    {
        if($this->discount)
        {
            $this->total_amount = (array_sum(array_column($this->cart, 'total'))) - ($this->discount);

             // Subtract discount from total
            $total = array_sum(array_map(function($item) {
                return (float) $item['total'];
            }, $this->cart));
    
            $this->cartTotal = number_format(max($total - $this->discount, 0), 2);
            
        }
        else 
        {
            $this->total_amount = array_sum(array_column($this->cart, 'total'));
        }

    }

    public function overview()
    {   
        if($this->payment_mode == 'GCASH' || $this->payment_mode == 'DEBIT CARD') {
            $this->validate([
                'ref_no' => 'required'
            ]);
        }

        $this->validate([
            'patient_id' => 'required|integer',
            'patient_name' => 'required',
            'payment_mode' => 'required',
        ]);

        $this->modalView = true;
    }

    public function closeModal()
    {
        $this->modalView = false;
        $this->modalAdd = false;
        $this->modalUpdate = false;
    }

    public function mount()
    {
        if ($this->appointment_id) {
            $appointment = Appointment::find($this->appointment_id);
            if ($appointment) {
                $serviceId = $appointment->service_id;
                if ($serviceId) {
                    // Add the service to the cart
                    $service = Service::find($serviceId);
                    if ($service) {
                        $this->addToCart($serviceId, 'service');
                    }
                }
            }
        }
    }

    // private function addAppointmentServicesToCart()
    // {
    //     // Fetch appointment services associated with the appointment_id
    //     $appointment = Appointment::find($this->appointment_id);
    //     if ($appointment) {
    //         $services = $appointment->service;

    //         foreach ($services as $service) {
    //             $this->cart[] = [
    //                 'id' => $service->service->id,
    //                 'name' => $service->service->service_name,
    //                 'type' => 'Service',
    //                 'quantity' => 1, 
    //                 'total' => $service->service->price, 
    //             ];
    //         }
    //     }
    // }

    // public function addToCart($itemId, $type)
    // {
    //     //Check if the quantity is null
    //     $this->validate([
    //         'quantity' => 'required|numeric|min:1',
    //     ]);

    //     $existingIndex = null;

    //     // Check if the selected ID already exists in the cart
    //     foreach ($this->cart as $index => $item) {
    //         if ($item['id'] == $itemId) {
    //             $existingIndex = $index;
    //             break;
    //         }
    //     }

    //     if ($type == 'product') {
    //         $item = Product::find($itemId);
    //     } elseif ($type == 'service') {
    //         $item = Service::find($itemId);
    //     } else {
    //         return;
    //     }

    //     $total = $this->quantity * $item->price;
    //     // $formattedTotal = number_format($total, 2);

    //     if ($existingIndex !== null) {
    //         // If the selected ID already exists in the cart, update the quantity and total
    //         $this->cart[$existingIndex]['quantity'] += $this->quantity;
    //         $this->cart[$existingIndex]['total'] += $total;
    //     } else {
    //         // If the selected ID doesn't exist in the cart, add it as a new item
    //         $this->cart[] = [
    //             'id' => $itemId,
    //             'name' => $item->product_name ?? $item->service_name,
    //             'type' => ucfirst($type),
    //             'quantity' => $this->quantity,
    //             'total' => $total,
    //         ];
    //     }
    // }

    public function addToCart($itemId, $type)
    {
        //Check if the quantity is null
        $this->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

        $existingIndex = null;

        // Check if the selected ID already exists in the cart
        foreach ($this->cart as $index => $item) {
            if ($item['id'] == $itemId) {
                $existingIndex = $index;
                break;
            }
        }

        if ($type == 'product') {
            $item = Product::find($itemId);
            $unitPrice = $item->price;
        } elseif ($type == 'service') {
            $item = Service::find($itemId);
            $unitPrice = $item->price;
        }
        elseif($type == 'promotion') {
            $item = Promo::find($itemId);
            $unitPrice = $item->price;
        } else {
            return;
        }

        // $unitPrice = $item->price;
        $subtotal = $this->quantity * $unitPrice;

        if ($existingIndex !== null) {
            // If the selected ID already exists in the cart, update the quantity, subtotal, and total
            $this->cart[$existingIndex]['quantity'] += $this->quantity;
            $this->cart[$existingIndex]['subtotal'] += $subtotal;
            $this->cart[$existingIndex]['total'] += $subtotal; // assuming total is the sum of all subtotals
        } else {
            // If the selected ID doesn't exist in the cart, add it as a new item
            $this->cart[] = [
                'id' => $itemId,
                'name' => $item->product_name ?? $item->service_name ?? $item->promo_name,
                'type' => ucfirst($type),
                'quantity' => $this->quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
                'total' => $subtotal, // assuming total is the same as subtotal for the first addition
            ];
        }

         // Update the cart totals
        $this->updateCartTotals();
    }

    public function promo()
    {
        if ($this->promo_id) {
            $promo = Promotion::find($this->promo_id);
            if ($promo) {
                $promoId = $promo->services->id;
                if ($promoId) {
                    // Add the service to the cart
                    $service = Service::find($promoId);
                    if ($service) {
                        $this->addToCart($promoId, 'promo');
                    }
                }
            }
        }
    }

    private function updateCartTotals()
    {
        $totalAmount = 0;
        foreach ($this->cart as $item) {
            // Exclude items with the type "promo" from the total calculation
            if ($item['type'] !== 'promo') {
                $totalAmount += $item['subtotal'];
            }
        }
        $this->total_amount = $totalAmount;
    }

    public function searchPatient() 
    {
        $patient = User::where('id', $this->patient_id)->where('role', 0)->first();

        $this->patient_name =  $patient->first_name . " " . $patient->middle_name . " " .  $patient->last_name;
    }


    public function removeFromCart($index)
    {
        // Remove item from cart by index
        unset($this->cart[$index]);
        
        // Re-index the array
        $this->cart = array_values($this->cart);

        // Update session
        session()->put('cart', $this->cart);
    }

    public function computeChange()
    {
        $this->change = $this->cash_rendered - $this->total_amount;
    }

    public function printInvoice()
    {

        // Check if appointment id in url
        // if ($this->appointment_id) {
        //     // Update Appointment Status
        //     $updateStatus = Appointment::where('id', $this->appointment_id)->first();

        //     $updateStatus->update([
        //         'status' => 'Completed'
        // ]);
        // }

        // $this->validate([
        //     'patient_id' => 'required|integer',
        //     'patient_name' => 'required',
        //     'payment_mode' => 'required'
        // ]);

        $order = Orders::create([
            'patient_id' => $this->patient_id,
            'patient_name' => $this->patient_name,
            'staff_id' => Auth::user()->id,
            'payment_mode' => $this->payment_mode,
            'total_amount' => $this->total_amount,
            'ref_no' => $this->ref_no
        ]);

         // Logs
         AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'TRANSACTION',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'COMPLETED TRANSACTION'
        ]);

         // Add items from the cart to order items
        foreach ($this->cart as $cartItem) {
            $order->items()->create([
                'item_id' => $cartItem['id'],
                'item_type' => $cartItem['type'],
                'quantity' => $cartItem['quantity'],
                'price' => $cartItem['total'],
            ]);

            // Decrement product quantity if the item is a product
            $product = Product::where('id', $cartItem['id'])->first();
            if ($product) {
                $product->total_qty -= $cartItem['quantity'];
                $product->save();
            }

            // Update inventory if needed
            $inventory = Inventory::where('product_id', $cartItem['id'])->first();
            if ($inventory) {
                $inventory->total_quantity -= $cartItem['quantity'];
                $inventory->save();
            }
        }


        if($this->appointment_id)
        {
            $this->modalSucess = true;
        }

        else 
        {
            Session::flash('checkout', 'Transaction Completed.');

            $this->redirectRoute('billing');
            
            $this->modalView = false;
        }

        // Print Invoice 

        $pdf = PDF::loadView('Admin.Dompdf.Invoice.invoice', ['cart' => $this->cart, 'total_amount' => $this->total_amount, 'order_no' => $this->order_no, 'patient_id'=> $this->patient_id, 'patient_name' => $this->patient_name, 'order_no' => $this->order_no, 'discount' => $this->discount, 'payment_mode' => $this->payment_mode]);
    
        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');
    
        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);
    
        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="invoice.pdf"',
        ];
    
        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);

        $this->reset();
    }

    public function proceedToSession()
    {
        $this->redirectRoute('session-progress', ['appointment_id' => $this->appointment_id, 'isProceed' => true]);
    }

}
