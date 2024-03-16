<div>
    <x-Essentials.page-title>Activity Log</x-Essentials.page-title>

    <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid">
        <div class="mb-4 flex gap-2 items-center justify-between">
            <div class="flex gap-2 items-center w-[80%]">
            </div>
            <div class="20%">
                <x-button class="flex gap-2 bg-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15M9 12l3 3m0 0 3-3m-3 3V2.25" />
                    </svg>                                       
                    {{ __('Export') }}
                </x-button>
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                <tr>
                    <th scope="col" class="px-6 py-6">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-6">
                        User
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Log Name
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Date & Time
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$log->id}}
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $log->user )
                        <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $log->user->profile_photo_url }}" alt="{{ $log->user->name }}"> </div>
                        <div class="ml-4">
                            <div class="text-xs font-medium text-gray-900"> {{ $log->user->first_name .  " " . $log->user->last_name }} </div>
                            <div class="text-xs text-gray-500"> {{ $log->user_type }} </div>
                        </div>
                        @else
                            <div>
                                <div class="text-sm font-medium text-gray-900"> {{ $log->user->first_name . " " . $log->user->last_name }} </div>
                                {{-- <div class="text-xs text-gray-500"> {{ $appointment->email }} </div> --}}
                            </div>
                        @endif
                    </th>
                    <td class="px-6 py-6">
                        {{$log->log_name}}
                    </td>
                    <td class="px-6 py-6">
                        {{$log->description}}
                    </td>
                    <td class="px-6 py-6">
                        <div>
                            <div class="text-xs font-medium text-gray-900"> {{\Carbon\Carbon::parse($log->created_at)->format('M, d, Y')}} </div>
                            <div class="text-xs text-gray-500">{{\Carbon\Carbon::parse($log->created_at)->diffForHumans()}} </div>
                        </div>
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

        <div class="mt-6">
            {{$logs->links()}}
        </div>
    </div>
</div>
