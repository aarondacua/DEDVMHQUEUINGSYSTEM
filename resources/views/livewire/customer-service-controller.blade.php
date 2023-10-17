<div class="w-full flex grid items-center pt-3 sm:pt-1">
    <div class="flex gap-5 grid-cols-2 justify-center">
        <div class="m-2">
            <div class="text-xl text-center mb-2">Current Serving</div>
            <div class="bg-red-50 rounded-lg border-2 border-gray-500 shadow-2xl">
                <div class="text-center sm:p-5 md:p-5 lg:p-7 text-xl md:text-4xl lg:text-4xl">
                    Queue Number
                </div>
                <div class="text-center sm:p-5 md:p-5 lg:p-10 text-xl md:text-2xl lg:text-7xl">
                    @foreach($customers as $customer)
                    @if($customer->status === 'in_progress')
                    <div class="rounded-lg bg-yellow-50 shadow"> {{ $customer->queue_number }}</div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="m-2">
            <div class="text-xl text-center mb-2">Awaiting</div>
            <div class="bg-red-50 rounded-lg border-2 border-gray-500 shadow-2xl">
                <div
                    class=" flex grid grid-cols-5 gap-2 text-center sm:p-5 md:p-5 lg:p-7 text-sm md:text-xl lg:text-2xl">

                    @foreach($customers as $customer)
                    @if ($customer->service->name === 'BILLING')
                    <div class="rounded-lg bg-yellow-50 shadow"> {{ $customer->queue_number }}</div>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="pt-7 justify-center flex">
        <div class="p-1"> <button class="btn btn-sm btn-primary shadow-xl"> <i
                    class="bi bi-arrow-right-circle-fill"></i> Next</button></div>
        <div class="p-1"> <button class="btn btn-sm btn-warning shadow-xl"> <i class="bi bi-megaphone-fill"></i>
                Call</button></div>
        <div class="p-1"> <button class="btn btn-sm btn-success shadow-xl"> <i
                    class="bi bi-caret-right-square-fill"></i> Start</button></div>
        <div class="p-1"> <button class="btn btn-sm btn-danger shadow-xl"> <i class="bi bi-x-circle-fill"></i>
                Close</button></div>
    </div>
</div>