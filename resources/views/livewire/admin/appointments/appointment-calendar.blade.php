<div>
    <div class="flex justify-between mb-6 items-center">
        <div>
            <x-Essentials.page-title>Appointment Calendar</x-Essentials.page-title>
        </div>

        <a href="{{route('add-appointment')}}">
            <x-button class="flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                </svg>                       
                {{ __('New Appointment') }}
            </x-button>
        </a>
    </div>

    {{-- Added Message --}}
    @if(Session::has('created'))
    <div id="alert-success" class="flex items-center p-4 mb-4 rounded-lg bg-green-500 text-white  dark:bg-gray-800 dark:text-blue-400" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium text-white">
            {{Session::get('created')}}
        </div>
    </div>
    @endif

    <div class="col-span-12 mt-6 mb-6">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-[#C7A7EA]"
                href="#">
                <div class="p-5">
                    <div class="flex justify-between">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg> --}}
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8 text-white">{{$ongoing}}</div>

                            <div class="mt-1 text-base text-white">On-Going</div>
                        </div>
                    </div>
                </div>
            </a>
            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-[#A4CAFE]"
                >
                <div class="p-5">
                    <div class="flex justify-between">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg> --}}

                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8 text-white">{{$confirmed}}</div>

                            <div class="mt-1 text-base text-white">Confirmed</div>
                        </div>
                    </div>
                </div>
            </a>
            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-[#F8B4B4]"
                href>
                <div class="p-5">
                    <div class="flex justify-between">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg> --}}
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8 text-white">{{$cancelled}}</div>

                            <div class="mt-1 text-base text-white">Cancelled</div>
                        </div>
                    </div>
                </div>
            </a>
            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-[#84E1BC]"
                href>
                <div class="p-5">
                    <div class="flex justify-between">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg> --}}
                        
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8 text-white">{{$completed}}</div>

                            <div class="mt-1 text-base text-white">Completed</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    
    <div id="calendar" class="bg-white rounded-lg shadow-md p-8 border border-solid">
    </div>

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
                events: @json($appointments),
                eventContent: renderEventContent,
                selectable: true,
                eventClick: function(info)
                {
                    window.location.href = "{{ route('view-appointments') }}" + "?appointment_id=" + info.event.id;
                }
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


