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
        // Add a customer to the queue with the selected service
        $customer = new Customer([
            'name' => $this->name,
            'queue_number' => Customer::where('service_id', $this->selectedService)->max('queue_number') + 1,
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
