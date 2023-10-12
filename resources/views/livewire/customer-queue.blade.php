
    <div class="w-full min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
           GET YOUR NUMBER HERE
        </div>
    
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('login') }}">
                @csrf
    
                <div>
                    <x-label for="Name" value="{{ __('Name') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div>
                    <x-label for="Name" value="{{ __('Service') }}" />
                    <select wire:model="selectedService" class="form-control" id="selectedService">
                        
                            <option value="">Billing Section</option>
                            <option value="">PhilHealth Section</option>
                      
                    </select>
                </div>
    
                
    
                
    
                <div class="flex items-center justify-end mt-4">
    
                    <x-button class="ml-4">
                        {{ __('Join Queue') }}
                    </x-button>
                </div>
            </form>

        </div>
    </div>

