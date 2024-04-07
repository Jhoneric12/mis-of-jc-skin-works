<div>
    <x-Essentials.page-title>My history</x-Essentials.page-title>

    <div class="bg-white border border-solid rounded-lg px-4 py-4  shadow-md w-full max-h-[700px] overflow-y-auto">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="settings-tab" data-tabs-target="#medical-records" type="button" role="tab" aria-controls="medical-records" aria-selected="false">Diagnosis</button>
            </li>
            <li class="me-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Sessions</button>
            </li>
        </ul>
        <div id="default-tab-content">
            <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div>
                    <div class="flex flex-col">
                            @forelse ($sessions as $session)
                                @if ($session->status ==='Completed' || $session->status === 'On-going')
                                    <div class="mt-2 flex flex-col gap-4 border-b border-b-[#D0D0D0] py-10 px-4">
                                        <div class="flex gap-1 justify-between">
                                            <div class="flex flex-col justify-between">
                                                <h1 class="text-base">{{$session->service->service_name}}</h1>
                                                {{-- <span class="text-xs">Appointment No. {{$session->id}}</span> --}}
                                                <span class="text-xs">{{\Carbon\Carbon::parse($session->created_at)->format('M, d, Y')}}</span>
                                            </div>
                                            <div>
                                                @if($session->status == 'Scheduled')
                                                <span class="bg-gray-300 text-white text-xs px-2 py-1 rounded-full">
                                                    {{ $session->status }}
                                                </span>
                                                @elseif($session->status == 'Cancelled')
                                                    <span class="bg-red-300 text-white text-xs px-2 py-1 rounded-full">
                                                        {{ $session->status }}
                                                    </span>
                                                @elseif($session->status == 'Completed')
                                                    <span class="bg-green-300 text-white text-xs px-2 py-1 rounded-full">
                                                        {{ $session->status }}
                                                    </span>
                                                @elseif($session->status == 'Confirmed')
                                                    <span class="bg-blue-300 text-white text-xs px-2 py-1 rounded-full">
                                                        {{ $session->status }}
                                                    </span>
                                                @elseif($session->status == 'On-going')
                                                    <span class="bg-[#C7A7EA] text-white text-xs px-2 py-1 rounded-full">
                                                        {{ $session->status }}
                                                    </span>
                                                @else
                                                    <span class="bg-gray-300 text-gray-800 text-xs px-2 py-1 rounded-full">
                                                        {{ $session->status }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{route('patient-session-progress', ['appointment_id' => $session->id])}}" class="w-full bg-green-300 p-2 rounded-lg text-green-500 font-bold hover:opacity-90 text-xs text-center">
                                            <button>View Session Progress</button>
                                        </a>
                                    </div>
                                @endif
                            @empty
                                <div class='text-center bg-white rounded-lg p-4'>
                                    <div class="flex flex-col items-center justify-center">
                                        <img src="{{ asset('assets/Essentials/No data-cuate.png') }}" alt="" class="h-40 w-40">
                                        <h1 class="text-sm font-semibold mb-2">No Results Found</h1>
                                    </div>
                                </div>
                            @endforelse
                    </div>
                </div>
            </div>
            <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="medical-records" role="tabpanel" aria-labelledby="settings-tab">
                <div>
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
                    <div class="mb-4 flex gap-2 items-center justify-between w-full">
                        <div></div>
                        <div class="flex gap-2 items-center">
                            <div role="status" wire:loading>
                                <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                            <tr>
                                {{-- <th scope="col" class="px-6 py-6">
                                    ID
                                </th> --}}
                                <th scope="col" class="px-6 py-6">
                                    Date Created
                                </th>
                                <th scope="col" class="px-6 py-6">
                                    Findings
                                </th>
                                <th scope="col" class="px-6 py-6">
                                    Prescription
                                </th>
                                {{-- <th scope="col" class="px-6 py-6">
                                    Action
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($records as $record)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                                {{-- <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$record->id}}
                                </td> --}}
                                <td class="px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    {{\Carbon\Carbon::parse($record->created_at)->format('M, d, Y')}}
                                </td>
                                <td scope="row" class="px-6 py-4 whitespace-normal dark:text-white">
                                    {{$record->findings}}
                                </td>
                                <td scope="row" class="px-6 py-4 whitespace-normal dark:text-white">
                                    {{$record->prescription}}
                                </td>
                                {{-- <td class="px-6 py-6 flex gap-2 items-center">
                                    <a href="{{route('view-medical-record', ['record_id' => $record->id])}}" class="hover:cursor-pointer text-[#5FC26C]">
                                        Full Details
                                    </a>                     
                                </td> --}}
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
                    <div class="mt-6">
                        {{$records->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
