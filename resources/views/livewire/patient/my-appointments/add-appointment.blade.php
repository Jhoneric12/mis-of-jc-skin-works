<div>
    <div class="flex gap-4">
        <a href="{{route('appointments')}}">
            <x-Essentials.page-title class="text-[#9D9D9D]">My Appointments</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title class="text-[#9D9D9D]"> > </x-Essentials.page-title>
        <x-Essentials.page-title>New Appointment</x-Essentials.page-title>
    </div>

    <form wire:submit.prevent='create' class='bg-gray-50 p-10 border border-solid border-t-4 border-t-[#5FC26C] border-t-solid shadow-md rounded-lg'>
        @csrf
        <div class='flex gap-4 w-full items-center'>
            {{-- <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                <x-label for="patient_id" value="{{ __('Patient ID') }}" />
                <x-input wire:model='patient_id' id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')"  autofocus autocomplete="firstname" />
                <x-input-error for="patient_id"/>
            </div> --}}
            <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                <x-label for="" value="{{ __('Service Name') }}" />
                                    <select wire:model='service_id' class='mt-1 border-gray-300 focus:border-[#4FBD5E] focus:ring-green-500 rounded-md shadow-sm'>
                                        <option  value="">- Select Options - </option>
                                        @foreach ($services as $service)
                                            @if ($service->status == true)
                                                <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <x-input-error for="service_id"/>
            </div>
            <div class='flex flex-col gap-1 mb-4 text-fontColor w-[50%]'>
                <x-label for="" value="{{ __('Specialist') }}" />
                                    <select wire:model='specialist_id' class='mt-1 border-gray-300 focus:border-[#4FBD5E] focus:ring-green-500 rounded-md shadow-sm'>
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
        <div class='flex gap-4 items-center'>
            <div class='flex flex-col gap-1 mb-4 w-[50%]'>
                <x-label for="birthdate" value="{{ __('Date') }}" />
                <x-input wire:model='date' id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('bDate')"  autofocus autocomplete="birthdate" />
                <x-input-error for="date"/>
            </div>
            <div class='flex flex-col gap-1 mb-4 w-[50%]'>
                <x-label for="age" value="{{ __('Time') }}" />
                <x-input wire:model='time' id="age" class="block mt-1 w-full" type="time" name="age" :value="old('age')"  autofocus autocomplete="age" />
                <x-input-error for="time"/>
            </div>
        </div>

        <div class='flex justify-end mt-6 items-center'>

            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>

            <button type="submit" class="text-sm text-center bg-[#4FBD5E] hover:opacity-90 text-white px-10 py-3 rounded-[8px]">Submit</button>
        </div>
    </form>

    <div id="calendar" class="relative bg-white rounded-lg shadow-md p-8 border border-solid w-full h-full mt-6">
    </div>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
        <script>
            document.addEventListener('livewire:init', function() {
            const calendarEl = document.getElementById('calendar')
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    // right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
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
                events: @json($appointments),
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
