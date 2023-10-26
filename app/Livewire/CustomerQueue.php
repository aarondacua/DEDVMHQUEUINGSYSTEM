<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\Customer;

class CustomerQueue extends Component
{
    public $name;
    public $selectedService = '';
    public $newlyAddedCustomer;

    public function addCustomer()
    {
        // Find the last customer for the selected service
        $lastCustomer = Customer::where('service_id', $this->selectedService)
            ->orderBy('created_at', 'desc')
            ->first();
    
        // Check if there is a last customer and if the date is different
        if ($lastCustomer && now()->toDateString() !== $lastCustomer->created_at->toDateString()) {
            // If the date is different, reset the queue_number to 1
            $queueNumber = 1;
        } else {
            // Otherwise, increment the queue_number
            $queueNumber = $lastCustomer ? $lastCustomer->queue_number + 1 : 1;
        }
    
        // Add a customer to the queue with the selected service
        $customer = new Customer([
            'name' => $this->name,
            'queue_number' => $queueNumber,
            'status' => 'awaiting',
            'service_id' => $this->selectedService,
        ]);
    
        $customer->save();
    
        session()->flash('success', 'Customer added successfully');
        $this->name = '';
        $this->selectedService = '';
        $this->newlyAddedCustomer = $customer; // Store the newly added customer
    
        // Optionally, you can clear the newly added customer after a few seconds:
        // $this->dispatchBrowserEvent('clearNewlyAddedCustomer'); // Add this line
    
        // You can use the above event to clear the newly added customer after a few seconds using JavaScript.
    }

    public function closeModal()
    {
        $this->newlyAddedCustomer = null;
    }

    public function render()
    {
        return view('livewire.customer-queue', ['services' => Service::get(),]);
    }
}
