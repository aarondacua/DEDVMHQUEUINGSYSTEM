<div class="w-full flex grid items-center pt-3 sm:pt-1">
    <div class="flex gap-5 grid-cols-2 justify-center">
        
        @foreach ($services as $service)
        <div class="m-2" wire:poll>
            <div class="text-xl text-center mb-2">{{$service->name}}</div>
            <div class=" rounded-lg  border-gray-500 shadow-2xl">
                <div
                    class=" flex grid grid-cols-5 gap-2 text-center sm:p-5 md:p-5 lg:p-7 text-sm">

                    @foreach($customers as $customer)
                    @if ($customer->service->name === $service->name && $customer->status === 'awaiting')
                    <ol>
                        <li>{{ $customer->name }}</li>
                    </ol>
                    {{-- <div id="nextQueueNumber"  class="rounded-lg "> {{ $customer->name }}</div> --}}
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
        @endforeach


</div>

<script>
    
 function speakCustomer() {
    // Get the queue number of the "in_progress" customer
    const inProgressQueueNumber = document.getElementById('inProgressQueueNumber').textContent;

    // Create a speech synthesis utterance
    const utterance = new SpeechSynthesisUtterance(`Customer number ${inProgressQueueNumber}, please proceed to the service counter.`);

    // Optionally, set voice parameters if needed
    // utterance.voice = speechSynthesis.getVoices()[0]; // Use a specific voice

    // Add error handling
    utterance.onerror = function (event) {
        console.error('Speech synthesis error:', event);
    };

    // Speak the utterance
    speechSynthesis.speak(utterance);
}

function nextCustomer() {
    // Get the queue number of the "in_progress" customer
    const nextQueueNumber = document.getElementById('nextQueueNumber').textContent;

    // Create a speech synthesis utterance
    const utterance = new SpeechSynthesisUtterance(`Customer number ${nextQueueNumber}, please proceed to the service counter.`);

    // Optionally, set voice parameters if needed
    // utterance.voice = speechSynthesis.getVoices()[0]; // Use a specific voice

    // Add error handling
    utterance.onerror = function (event) {
        console.error('Speech synthesis error:', event);
    };

    // Speak the utterance
    speechSynthesis.speak(utterance);
}
    </script>