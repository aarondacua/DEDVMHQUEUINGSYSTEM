<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\Customer;

class CustomerServiceController extends Component
{
    public function render()
    {
        $customers = Customer::orderBy('queue_number')->get();
        $services = Service::all();
        return view('livewire.customer-service-controller', ['customers' => $customers, 'services' => $services]);
    }
}
