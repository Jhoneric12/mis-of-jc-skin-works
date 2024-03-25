<?php

namespace App\Livewire\Admin\Settings\Services;

ini_set('max_execution_time', 18000);

use App\Models\AuditTrail;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ManageServices extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $modalAdd = false;
    public $modalUpdate = false;
    public $modalView = false;
    public $modalImage = false;
    public $modalStatus = false;
    public $search = '';
    public $filter = 'Active';
    public $category = 'All';

    public $service_name;
    public $service_id;
    public $service_category_id;
    public $description;
    public $price;
    public $status;
    public $sessions;
    public $image;

    public function render()
    {
        $query = Service::query()
            ->where('service_name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc');

        if ($this->filter !== 'All') {
            $status = $this->filter === 'Active' ? 1 : 0;
            $query->where('status', $status);
        }

        if ($this->category !== 'All') {
            $query->where('service_category_id', $this->category);
        }

        $services = $query->paginate(10);

        return view('livewire.admin.settings.services.manage-services', [
            'services' => $services,
            'categories' => ServiceCategory::where('status', 1)->get()
        ]);
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
            'service_name' => 'required|unique:services',
            'description' => 'required',
            'price' => 'required',
            'sessions' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image =  $this->image->store('photos', 'public');

        Service::create([
            'service_name' => strtoupper($this->service_name),
            'service_category_id' => $this->service_category_id,
            'description' => strtoupper($this->description),
            'price' => $this->price,
            'nno_of_sessions' => $this->sessions,
            'image_path' => $image
        ]);

        $this->resetFields();
        $this->dispatch('created');
        $this->modalAdd = false;
    }

    public function editModal($id)
    {
        $this->modalUpdate = true;

        $this->service_id = $id;

        $service_id = Service::where('id', $id)->first();

        $this->service_name = $service_id->service_name;
        $this->service_category_id = $service_id->service_category_id;
        $this->description = $service_id->description;
        $this->price = $service_id->price;
        $this->status = $service_id->status;
        $this->sessions = $service_id->nno_of_sessions;

    }

    public function editStatus($id)
    {
        $this->modalStatus = true;

        $this->service_id = $id;

        $service_id = Service::where('id', $id)->first();

        $this->service_name = $service_id->service_name;
    }

    public function editImage($id)
    {
        $this->modalImage = true;

        $this->service_id = $id;

        $service_id = Service::where('id', $id)->first();

        $this->service_name = $service_id->service_name;
    }

    public function updateImage()
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $updateImage = Service::where('id', $this->service_id)->first();

        $image =  $this->image->store('photos', 'public');

        $updateImage->update([
            'image_path' => $image
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function updateStatus()
    {
        $this->validate(['status' => 'required']);
        
        $updateStatus = Service::where('id', $this->service_id);
        
        $status = $this->status == 'Active' ? 1 : 0;

        $updateStatus->update([
            'status' => $status
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function update()
    {
        $this->validate([
            'service_name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'sessions' => 'required'
        ]);

        $updateService = Service::where('id', $this->service_id);

        $updateService->update([
            'service_name' => strtoupper($this->service_name),
            'service_category_id' => $this->service_category_id,
            'description' => strtoupper($this->description),
            'price' => $this->price,
            'nno_of_sessions' => $this->sessions,
        ]);

        $this->resetFields();
        $this->dispatch('updated');
    }

    public function view($id)
    {
        $this->modalView = true;

        $this->service_id = $id;

        $service_category_id = Service::where('id', $id)->first();

        $this->service_name = $service_category_id->service_name;
        $this->service_category_id = $service_category_id->category->category_name;
        $this->price = $service_category_id->price;
        $this->description = $service_category_id->description;
        $this->status = $service_category_id->status;
        $this->sessions = $service_category_id->nno_of_sessions;
    }

    public function export()
    {
        $data = Service::latest()->get();
        $pdf = PDF::loadView('Admin.Dompdf.Services.services', ['data' => $data]);

        // Generate a temporary file path for the PDF
        $tempFilePath = tempnam(sys_get_temp_dir(), 'patients');

        // Save the PDF to the temporary file with the desired filename
        $pdf->save($tempFilePath);

        // Set appropriate headers for streaming
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="services_list_report.pdf"',
        ];

        // Logs
        AuditTrail::create([
            'user_id' => Auth::user()->id,
            'log_name' => 'SERVICES',
            'user_type' => 'ADMINISTRATOR',
            'description' => 'EXPORTED SERVICES'
        ]);

        // Return the response to stream the PDF with the specified filename
        return response()->file($tempFilePath, $headers)->deleteFileAfterSend(true);
    }
}
