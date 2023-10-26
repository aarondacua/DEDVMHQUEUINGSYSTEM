<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\Customer;

class CustomerServiceController extends Component
{
    public function updateStatus($serviceId)
    {
        // Find the customer with the lowest queue_number, 'awaiting' status, and the specified service ID
        $oldestCustomer = Customer::where('status', 'awaiting')
            ->where('service_id', $serviceId)
            ->orderBy('queue_number', 'asc')
            ->first();
    
        if (!$oldestCustomer) {
            session()->flash('error', 'No customers in the queue with the specified service');
            return;
        }
    
        // Find the customer with 'in progress' status for the same service
        $currentInProgressCustomer = Customer::where('status', 'in_progress')
            ->where('service_id', $serviceId)
            ->first();
    
        // Update the status of the oldest customer to 'in progress'
        $oldestCustomer->status = 'in_progress';
        $oldestCustomer->save();
    
        session()->flash('success', 'Status of the oldest customer with service updated to "in progress"');
    
        if ($currentInProgressCustomer) {
            // Update the status of the current 'in progress' customer to 'close'
            $currentInProgressCustomer->status = 'completed';
            $currentInProgressCustomer->save();
    
            session()->flash('success', 'Status of the current "in progress" customer with service updated to "close"');
        }
    }

    public function render()
    {
        $customers = Customer::orderBy('queue_number')->get();
        $services = Service::all();
        return view('livewire.customer-service-controller', ['customers' => $customers, 'services' => $services]);
    }
}
