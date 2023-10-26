<div class="w-full flex grid items-center pt-3 sm:pt-1">
    <div class="flex gap-5 grid-cols-2 justify-center">
        <div class="m-2">
            <div class="text-xl text-center mb-2">Current Serving</div>
            <div class=" rounded-lg  border-gray-500 shadow-2xl">
                <div class="text-center sm:p-5 md:p-5 lg:p-7 text-xl md:text-4xl lg:text-4xl">
                    Queue Number
                </div>
                <div class="text-center sm:p-5 md:p-5 lg:p-10 text-xl md:text-2xl lg:text-7xl">
                    @foreach($customers as $customer)
                        @if($customer->service->name === 'BILLING' && $customer->status === 'in_progress')
                            <div wire:poll.visible class="rounded-lg bg-yellow-50 shadow" id="inProgressQueueNumber"> {{ $customer->queue_number }}</div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="m-2">
            <div class="text-xl text-center mb-2">Awaiting</div>
            <div class=" rounded-lg  border-gray-500 shadow-2xl">
                <div
                    class=" flex grid grid-cols-5 gap-2 text-center sm:p-5 md:p-5 lg:p-7 text-sm md:text-xl lg:text-2xl">

                    @foreach($customers as $customer)
                    @if ($customer->service->name === 'BILLING' && $customer->status === 'awaiting')
                    <div id="nextQueueNumber"  class="rounded-lg "> {{ $customer->queue_number }}</div>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="pt-7 justify-center flex">
        <button wire:click="updateStatus(1)" class="btn btn-sm btn-primary shadow-xl" onclick="nextCustomer()">
            <i class="bi bi-arrow-right-circle-fill"></i> Next
        </button>
        <div class="p-1"> <button class="btn btn-sm btn-warning shadow-xl"onclick="speakCustomer()"> <i class="bi bi-megaphone-fill"></i>
                Call</button></div>
        <div class="p-1"> <button class="btn btn-sm btn-success shadow-xl"> <i
                    class="bi bi-caret-right-square-fill"></i> Start</button></div>
        <div class="p-1"> <button class="btn btn-sm btn-danger shadow-xl"> <i class="bi bi-x-circle-fill"></i>
                Close</button></div>
    </div>
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