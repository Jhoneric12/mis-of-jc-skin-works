<div>
    <x-Essentials.page-title>Dashboard</x-Essentials.page-title>

    <main class="mt-[-4rem]">
        <div class="grid mb-4 pb-10  rounded-3xl bg-gray-100">

            <div class="grid grid-cols-12 gap-6">
                <div class="grid grid-cols-12 col-span-12 gap-6 xxl:col-span-9">
                    <div class="col-span-12 mt-8">
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="{{route('manage-product-table')}}">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 text-3xl font-bold leading-8">{{$appointment_today}}</div>

                                            <div class="mt-1 text-base text-gray-600">Appointment Today</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="#">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
        
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 text-3xl font-bold leading-8">{{$total_patients}}</div>

                                            <div class="mt-1 text-base text-gray-600">No. of Patients</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="{{route('manage-patients')}}">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                                        </svg>
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 text-3xl font-bold leading-8">{{$total_prescriptions}}</div>

                                            <div class="mt-1 text-base text-gray-600">Prescriptions</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                                href="{{route('manage-product-table')}}">
                                <div class="p-5">
                                    <div class="flex justify-between">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                                        </svg>
                                        
                                    </div>
                                    <div class="ml-2 w-full flex-1">
                                        <div>
                                            <div class="mt-3 text-3xl font-bold leading-8">{{$treated_patients}}</div>

                                            <div class="mt-1 text-base text-gray-600">Treated Patients</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-span-12">
                        {{-- Updated Message --}}
                        <x-action-message on="confirmed" class="w-full text-white bg-green-500 rounded-lg mb-4">
                            <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="mx-3 text-white">Appointment approved.</p>
                                </div>
                            </div>
                        </x-action-message>

                        {{-- Cancel Message --}}
                        <x-action-message on="cancelled" class="w-full text-white bg-red-500 rounded-lg mb-4">
                            <div class="container flex items-center justify-between px-6 py-4 mx-auto">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                    </svg>
                                    <p class="mx-3 text-white">Appointment declined.</p>
                                </div>
                            </div>
                        </x-action-message>
                        <div class="flex justify-between mb-6">
                            <div role="status" wire:loading>
                                <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div></div>
                        </div>
                        <div class="grid gap-2 grid-cols-1 lg:grid-cols-1 mb-6">
                            <div class="bg-white p-4 shadow-lg rounded-lg">
                                <h1 class="font-bold text-base text-[#4FBD5E]">Appointments Today</h1>
                                <div class="mt-4">
                                    <div class="flex flex-col">
                                        <div class="-my-2 overflow-x-auto">
                                            <div class="py-2 align-middle inline-block min-w-full">
                                                <div
                                                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                                                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
                                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                                                            <tr>
                                                                <th scope="col" class="px-6 py-6">
                                                                    Appointment ID
                                                                </th>
                                                                <th scope="col" class="px-6 py-6">
                                                                    Patient
                                                                </th>
                                                                {{-- <th scope="col" class="px-6 py-6">
                                                                    Date
                                                                </th>
                                                                <th scope="col" class="px-6 py-6">
                                                                    Time
                                                                </th> --}}
                                                                <th scope="col" class="px-6 py-6">
                                                                    Date & Time
                                                                </th>
                                                                <th scope="col" class="px-6 py-6">
                                                                    Specialist
                                                                </th>
                                                                <th scope="col" class="px-6 py-6">
                                                                    Status
                                                                </th>
                                                                <th scope="col" class="px-6 py-6">
                                                                    Action
                                                                </th>
                                                                {{-- <th scope="col" class="px-6 py-6">
                                                                    Action
                                                                </th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($appointments as $appointment)
                                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                                                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                    {{$appointment->id}}
                                                                </td>
                                                                <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $appointment->patient )
                                                                    <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $appointment->patient->profile_photo_url }}" alt="{{ $appointment->patient->name }}"> </div>
                                                                    <div class="ml-4">
                                                                        <div class="text-xs font-medium text-gray-900"> {{ $appointment->patient->first_name .  " " . $appointment->patient->last_name }} </div>
                                                                        <div class="text-xs text-gray-500"> {{ $appointment->patient->email }} </div>
                                                                    </div>
                                                                    @else
                                                                        <div>
                                                                            <div class="text-sm font-medium text-gray-900"> {{ $appointment->first_name . " " . $appointment->last_name }} </div>
                                                                            {{-- <div class="text-xs text-gray-500"> {{ $appointment->email }} </div> --}}
                                                                        </div>
                                                                    @endif
                                                                </th>
                                                                <td class="px-6 py-6">
                                                                    <div>
                                                                        <div class="text-xs font-medium text-gray-900"> {{\Carbon\Carbon::parse($appointment->date)->format('M, d, Y')}} </div>
                                                                        <div class="text-xs text-gray-500"> {{\Carbon\Carbon::parse($appointment->time)->format('g: i a')}} </div>
                                                                    </div>
                                                                </td>
                                                                <td class=" px-6 py-6">
                                                                    {{-- @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $appointment->patient )
                                                                    <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $appointment->specialist->profile_photo_url }}" alt="{{ $appointment->specialist->name }}"> </div>
                                                                    <div class="ml-4">
                                                                        <div class="text-xs font-medium text-gray-900"> {{ $appointment->specialist->first_name .  " " . $appointment->specialist->last_name }} </div>
                                                                        <div class="text-xs text-gray-500"> {{ $appointment->specialist->email }} </div>
                                                                    </div>
                                                                    @else
                                                                        <div>
                                                                            <div class="text-sm font-medium text-gray-900"> {{ $appointment->first_name . " " . $appointment->last_name }} </div>
                                                                            <div class="text-xs text-gray-500"> {{ $appointment->email }} </div>
                                                                        </div>
                                                                    @endif --}}
                                                                    {{$appointment->service->service_name}}
                                                                </td>
                                                                {{-- <td class="px-6 py-6">
                                                                    {{$appointment->setting}}
                                                                </td> --}}
                                                                <td class="px-6 py-6">
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
                                                                </td>
                                                                <td class="px-6 py-6 flex gap-2 ">
                                                                    <a href="{{route('doctor-view-appointment', ['appointment_id' => $appointment->id])}}" class="hover:cursor-pointer text-[#5FC26C]">
                                                                        View Details
                                                                    </a>                     
                                                                </td>
                                                            </tr>
                                                            @empty
                                                                <tr class="w-full">
                                                                    <td colspan="6" class="text-center py-4">
                                                                        <div class="flex flex-col items-center justify-center">
                                                                            <img src="{{ asset('assets/Essentials/No data-cuate.png') }}" alt="" class="h-40 w-40">
                                                                            <h1 class="text-md font-semibold mb-2">No Results Found</h1>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="mt-6">
                                                    {{$appointments->links()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between mb-6">
                            <div role="status" wire:loading>
                                <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div></div>
                        </div>

                        <div class="bg-white p-4 shadow-lg rounded-lg ">
                            <h1 class="font-bold text-base text-[#4FBD5E]">Pending Appointments</h1>
                            <div class="mt-4">
                                <div class="flex flex-col">
                                    <div class="-my-2 overflow-x-auto">
                                        <div class="py-2 align-middle inline-block min-w-full">
                                            <div
                                                class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
                                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-6">
                                                                Appointment ID
                                                            </th>
                                                            <th scope="col" class="px-6 py-6">
                                                                Patient
                                                            </th>
                                                            <th scope="col" class="px-6 py-6">
                                                                Date & Time
                                                            </th>
                                                            {{-- <th scope="col" class="px-6 py-6">
                                                                Specialist
                                                            </th> --}}
                                                                <th scope="col" class="px-6 py-6">
                                                                    Service
                                                                </th>
                                                            <th scope="col" class="px-6 py-6">
                                                                Action
                                                            </th>
                                                            {{-- <th scope="col" class="px-6 py-6">
                                                                Action
                                                            </th> --}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($pending_appointments as $appointment)
                                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                                                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                {{$appointment->id}}
                                                            </td>
                                                            <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $appointment->patient )
                                                                <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $appointment->patient->profile_photo_url }}" alt="{{ $appointment->specialist->name }}"> </div>
                                                                <div class="ml-4">
                                                                    <div class="text-xs font-medium text-gray-900"> {{ $appointment->patient->first_name .  " " . $appointment->patient->last_name }} </div>
                                                                    <div class="text-xs text-gray-500"> {{ $appointment->patient->email }} </div>
                                                                </div>
                                                                @else
                                                                    <div>
                                                                        <div class="text-sm font-medium text-gray-900"> {{ $appointment->first_name . " " . $appointment->last_name }} </div>
                                                                        {{-- <div class="text-xs text-gray-500"> {{ $appointment->email }} </div> --}}
                                                                    </div>
                                                                @endif
                                                            </th>
                                                            <td class="px-6 py-6">
                                                                <div>
                                                                    <div class="text-xs font-medium text-gray-900"> {{\Carbon\Carbon::parse($appointment->date)->format('M, d, Y')}} </div>
                                                                    <div class="text-xs text-gray-500"> {{\Carbon\Carbon::parse($appointment->time)->format('g: i a')}} </div>
                                                                </div>
                                                            </td>
                                                                {{-- <td class="px-6 py-6">
                                                                    {{$appointment->setting}}
                                                                </td> --}}
                                                            <td class="px-6 py-6">
                                                                {{$appointment->service->service_name}}
                                                            </td>
                                                            {{-- <td class="px-6 py-6">
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
                                                                @else
                                                                    <span class="bg-gray-300 text-gray-800 text-xs px-2 py-1 rounded-full">
                                                                        {{ $appointment->status }}
                                                                    </span>
                                                                @endif
                                                            </td> --}}
                                                            <td class="px-6 py-6 flex gap-2 items-center">
                                                                <svg wire:click='confirm({{$appointment->id}})' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-[#4FBD5E] font-bold">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                  </svg>                                                                      
                                                                  <svg wire:click='cancel({{$appointment->id}})' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                                  </svg>
                                                                  
                                                                  
                                                            </td>
                                                        </tr>
                                                        @empty
                                                            <tr class="w-full">
                                                                <td colspan="6" class="text-center py-4">
                                                                    <div class="flex flex-col items-center justify-center">
                                                                        <img src="{{ asset('assets/Essentials/No data-cuate.png') }}" alt="" class="h-40 w-40">
                                                                        <h1 class="text-md font-semibold mb-2">No Results Found</h1>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{-- <div class="mt-6">
                                                {{$pending_appointments->links()}}
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-span-12">
                        <div class="grid gap-2 grid-cols-1 lg:grid-cols-2">
                            <div class="bg-white shadow-lg p-4" id="chartline"></div>
                            <div class="bg-white shadow-lg" id="chartpie"></div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        function data() {
          
            return {
               
                isSideMenuOpen: false,
                toggleSideMenu() {
                    this.isSideMenuOpen = !this.isSideMenuOpen
                },
                closeSideMenu() {
                    this.isSideMenuOpen = false
                },
                isNotificationsMenuOpen: false,
                toggleNotificationsMenu() {
                    this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
                },
                closeNotificationsMenu() {
                    this.isNotificationsMenuOpen = false
                },
                isProfileMenuOpen: false,
                toggleProfileMenu() {
                    this.isProfileMenuOpen = !this.isProfileMenuOpen
                },
                closeProfileMenu() {
                    this.isProfileMenuOpen = false
                },
                isPagesMenuOpen: false,
                togglePagesMenu() {
                    this.isPagesMenuOpen = !this.isPagesMenuOpen
                },
               
            }
        }
    </script>
    <script>
        var chart = document.querySelector('#chartline')
        var options = {
            series: [{
                name: 'TEAM A',
                type: 'area',
                data: [44, 55, 31, 47, 31, 43, 26, 41, 31, 47, 33]
            }, {
                name: 'TEAM B',
                type: 'line',
                data: [55, 69, 45, 61, 43, 54, 37, 52, 44, 61, 43]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            stroke: {
                curve: 'smooth'
            },
            fill: {
                type: 'solid',
                opacity: [0.35, 1],
            },
            labels: ['Dec 01', 'Dec 02', 'Dec 03', 'Dec 04', 'Dec 05', 'Dec 06', 'Dec 07', 'Dec 08', 'Dec 09 ',
                'Dec 10', 'Dec 11'
            ],
            markers: {
                size: 0
            },
            yaxis: [{
                    title: {
                        text: 'Series A',
                    },
                },
                {
                    opposite: true,
                    title: {
                        text: 'Series B',
                    },
                },
            ],
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function(y) {
                        if (typeof y !== "undefined") {
                            return y.toFixed(0) + " points";
                        }
                        return y;
                    }
                }
            }
        };
        var chart = new ApexCharts(chart, options);
        chart.render();
    </script>
    <script>
        var chart = document.querySelector('#chartpie')
        var options = {
            series: [44, 55, 67, 83],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    dataLabels: {
                        name: {
                            fontSize: '22px',
                        },
                        value: {
                            fontSize: '16px',
                        },
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function(w) {
                                // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                return 249
                            }
                        }
                    }
                }
            },
            labels: ['Apples', 'Oranges', 'Bananas', 'Berries'],
        };
        var chart = new ApexCharts(chart, options);
        chart.render();
    </script>
</div>
