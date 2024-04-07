<div>
    <x-Essentials.page-title>My Appointments</x-Essentials.page-title>

    {{-- Added Message --}}
    <x-action-message on="created" class="w-full text-white bg-green-500 rounded-lg mb-4">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <p class="mx-3 text-white">Scheduled successfully.</p>
            </div>
        </div>
    </x-action-message>

    {{-- Updated Message --}}
    <x-action-message on="updated" class="w-full text-white bg-green-500 rounded-lg mb-4">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <p class="mx-3 text-white">Re-scheduled successfully.</p>
            </div>
        </div>
    </x-action-message>

    {{-- Cancelled Message --}}
    <x-action-message on="cancelled" class="w-full text-white bg-red-500 rounded-lg mb-4">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <p class="mx-3 text-white">Cancelled successfully.</p>
            </div>
        </div>
    </x-action-message>

    <div class="flex justify-between">
        <div></div>
        <div>
            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <x-button class="flex gap-2" wire:click="openModal" wire:loading.attr="disabled">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>                       
                {{ __('New Appointment') }}
            </x-button>
        </div>
    </div>

    <div class="container mx-auto">
        <div class="mt-8 grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-2 grid-rows-auto gap-6">
            @forelse ($appointments as $appointment)
                <div class="bg-white px-6 py-6 md:py-8 rounded-md shadow-lg w-full">
                    <div class="py-3 border-b border-b-solid border-b-[green] flex justify-between items-center">
                        <h1 class="text-sm md:text-base lg:text-lg font-bold">{{$appointment->service->service_name}}</h1>
                        @if($appointment->status == 'Scheduled')
                                <span class="bg-gray-300 text-white text-xs px-2 py-1 rounded-full">
                                    {{ $appointment->status }}
                                </span>
                                @elseif($appointment->status == 'Cancelled')
                                    <span class="bg-red-300 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @elseif($appointment->status == 'Completed')
                                    <span class="bg-green-300 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @elseif($appointment->status == 'Confirmed')
                                    <span class="bg-blue-300 text-white text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @elseif($appointment->status == 'On-going')
                                    <span class="bg-[#C7A7EA] text-white text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @else
                                    <span class="bg-gray-300 text-gray-800 text-xs px-2 py-1 rounded-full">
                                        {{ $appointment->status }}
                                    </span>
                                @endif
                    </div>
                    <div class="py-6 flex flex-col gap-4">
                        <div>
                            <div class="font-semibold text-xs md:text-sm">{{$appointment->id}}</div>
                            <div class="text-xs md:text-sm">Appointment No.</div>
                        </div>
                        <div class="flex gap-8 md:gap-40 items-center">
                            <div>
                                <div class="font-semibold text-xs md:text-sm">Dr. {{$appointment->specialist->last_name}}</div>
                                <div class="text-xs md:text-sm">Doctor/Staff</div>
                            </div>
                            <div>
                                <div class="font-semibold text-xs md:text-sm">{{$appointment->service->service_name}}</div>
                                <div class="text-xs md:text-sm">Service Name</div>
                            </div>
                        </div>
                        <div class="flex gap-8 md:gap-40 items-center">
                            <div>
                                <div class="font-semibold text-xs md:text-sm">{{\Carbon\Carbon::parse($appointment->time)->format('g: i a')}}</div>
                                <div class="text-xs md:text-sm">Time</div>
                            </div>
                            <div>
                                <div class="font-semibold text-xs md:text-sm">{{\Carbon\Carbon::parse($appointment->date)->format('M, d, Y')}}</div>
                                <div class="text-xs md:text-sm">Date</div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row w-full gap-4 mt-auto">
                        <x-Essentials.button class="w-full bg-green-300 font-bold text-xs md:text-xs" wire:click='editModal({{$appointment->id}})'>Re-Schedule</x-Essentials.button>
                        <x-Essentials.button class="w-full bg-red-300 text-[#FD4949] font-bold text-xs md:text-xs" wire:click='editStatus({{$appointment->id}})'>Cancel booking</x-Essentials.button>
                    </div>
                </div>
            @empty
                <div class='text-center p-4 flex flex-col items-center justify-center w-full'>
                    <div class="">
                        <img src="{{ asset('assets/Essentials/No data-cuate.png') }}" alt="" class="h-40 w-40">
                        <h1 class="text-md md:text-lg font-semibold mb-2">No Appointment Found</h1>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    

    {{-- Add Modal --}}
    <x-dialog-modal wire:model.live="modalAdd" maxWidth='4xl'>
        <x-slot name="title">
            {{ __('New Appointment') }}
        </x-slot>
    
        <x-slot name="content">

            {{-- <div id="calendar" class="relative bg-white rounded-lg shadow-md p-8 border border-solid w-full h-[20rem]">
            </div> --}}

            <form wire:submit='create'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class='flex flex-col gap-4 mb-4 w-full sm:flex-row sm:gap-8'>
                            <div class="w-full">
                                <x-label for="" value="{{ __('Service Name') }}" />
                                <select wire:model='service_id' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option  value="">- Select Options - </option>
                                    @foreach ($services as $service)
                                        @if ($service->status == true)
                                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error for="service_id"/>
                            </div>
                            <div class="w-full">
                                <x-label for="" value="{{ __('Specialist') }}" />
                                <select wire:model='specialist_id' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option  value="">- Select Options - </option>
                                    @foreach ($specialists as $specialist)
                                        @if ($specialist->role == 2 || $specialist->role == 3)
                                            <option value="{{ $specialist->id }}">{{ $specialist->first_name . " " . $specialist->last_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error for="specialist_id"/>
                            </div>
                        </div>
                        <div class='w-full flex flex-col gap-4 sm:flex-row sm:gap-8'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full sm:w-1/2'>
                                <x-label for="" value="{{ __('Date') }}" />
                                <input wire:model="date" type="date"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="date"/>
                            </div>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full sm:w-1/2'>
                                <x-label for="" value="{{ __('Time') }}" />
                                <input wire:model="time" type="time"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="time"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>
    
        <x-slot name="footer">
            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>
    
            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='create'>
                {{ __('Add') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
    

    {{-- Update Modal --}}
    <x-dialog-modal wire:model.live="modalUpdate" maxWidth='4xl'>
        <x-slot name="title">
            {{ __('Edit Appointment') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit='update'>
                @csrf
                <div>
                    <div class='flex flex-col w-full'>
                        <div class='flex flex-col gap-4 mb-4 w-full sm:flex-row sm:gap-8'>
                            <div class="w-full">
                                <x-label for="" value="{{ __('Service Name') }}" />
                                <select wire:model='service_id' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option  value="">- Select Options - </option>
                                    @foreach ($services as $service)
                                        @if ($service->status == true)
                                            <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-full">
                                <x-label for="" value="{{ __('Specialist') }}" />
                                <select wire:model='specialist_id' class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <option  value="">- Select Options - </option>
                                    @foreach ($specialists as $specialist)
                                        @if ($specialist->role == 2 || $specialist->role == 3)
                                            <option value="{{ $specialist->id }}">{{ $specialist->first_name . " " . $specialist->last_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class='w-full flex flex-col gap-4 sm:flex-row sm:gap-8'>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full sm:w-1/2'>
                                <x-label for="" value="{{ __('Date') }}" />
                                <input wire:model="date" type="date"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="date"/>
                            </div>
                            <div class='flex flex-col gap-1 mb-4 text-fontColor w-full sm:w-1/2'>
                                <x-label for="" value="{{ __('Time') }}" />
                                <input wire:model="time" type="time"  class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <x-input-error for="time"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='update'>
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>


    {{-- Update Status --}}
    <x-dialog-modal wire:model.live="modalStatus" maxWidth='lg'>
        <x-slot name="title">
            {{ __('Cancel booking') }}
        </x-slot>

        <x-slot name="content">
            <form wire:submit='cancel'>
                @csrf
                <h1 class=" text-sm font-semibold">Are you sure you want to cancel this booking?</h1>    
            </form>
        </x-slot>

        <x-slot name="footer">
            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('No') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:loading.attr="disabled" type='submit' wire:click='cancel'>
                {{ __('Yes') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
        <script>
            document.addEventListener('livewire:init', function() {
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                dayMaxEventRows: true,
                    views: {
                        timeGrid: {
                            dayMaxEventRows: 2,
                            eventDisplay: 'block'
                        }
                    },
                slotMinTime: '8:00:00',
                slotMaxTime: '19:00:00',
                events: @json($appointment_calendar),
                eventContent: renderEventContent,
                selectable: true,
                // eventClick: function(info)
                // {
                //     window.location.href = "{{ route('view-appointments') }}" + "?appointment_id=" + info.event.id;
                // }
            })
        
            function renderEventContent(info) {
                    const backgroundColor = getStatusBackgroundColor(info.event.extendedProps.status);
                    
                    return {
                        html: `<div style="background-color: ${backgroundColor}; padding: 5px; border-color:  ${backgroundColor};">
                                <div class="text-xs">${info.event.id}  ${info.event.extendedProps.setting}</div>
                                <div class="text-xs">${info.event.extendedProps.time}</div>
                            </div>`,
                    };
                }
        
                function getStatusBackgroundColor(status) {
                    switch (status) {
                        case 'Cancelled':
                            return '#F8B4B4'; 
                        case 'Completed':
                            return '#84E1BC'; 
                        case 'Confirmed':
                            return '#A4CAFE'
                        case 'Scheduled':
                            return '#D1D5DB'; 
                        case 'On-going':
                            return '#C7A7EA'; 
                        default:
                            return '#0000FF';
                    }
                }
            calendar.render()
            })
        </script>
    @endpush

    @push('styles')
        <style>
            #calendar .fc-toolbar button {
                background-color: white;
                color: black;
                border: 1px solid green;
            }
        </style>
    @endpush
    
</div>
