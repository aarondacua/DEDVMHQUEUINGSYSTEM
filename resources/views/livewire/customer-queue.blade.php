<div class="w-full min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    
    <div class=" text-gray-800 text-center text-5xl my-20">
        DON EMILIO DEL VALLE MEMORIAL HOSPITAL
        <br>
        QUEUING SYSTEM
    </div>
    
    
    <div class="text-2xl ">
        GET YOUR NUMBER HERE!
    </div>
    @if(session('success'))


    {{-- <div class="alert alert-success">
        {{ session('success') }}
    </div> --}}


    @endif
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <form wire:submit.prevent="addCustomer">
            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input wire:model="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
            </div>
        
            <div>
                <x-label for="selectedService" value="{{ __('Service') }}" />
                <select wire:model="selectedService" class="form-control" id="selectedService" name="selectedService" required>
                    <option value="" selected disabled>Select Service</option>
        
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4">
                    {{ __('Join Queue') }}
                </x-button>
            </div>
        </form>
        



        @if($newlyAddedCustomer)
        <x-modal>
            <!-- Display the newly added customer as a table -->
            <div class="flex justify-center m-4 py-4">
                Successfully Added!
            </div>
            <div class="flex justify-center m-4">
                <table class="table table-striped">
                    <tr>
                        <td>Service : {{ $newlyAddedCustomer->service->name }}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Name: {{ $newlyAddedCustomer->name }}</td>
                    </tr>
                    <tr>
                        <td>Queue Number: {{ $newlyAddedCustomer->queue_number }}</td>
                        <td></td>
                    </tr>
                </table>

            </div>
            <div class="flex justify-center m-4 py-4">
                <x-button class="ml-4" wire:click="closeModal">
                    {{ __('Close') }}
                </x-button>

                <x-button class="ml-4" wire:click="closeModal">
                    {{ __('Print') }}
                </x-button>
            </div>
        </x-modal>

        @endif

    </div>
</div>