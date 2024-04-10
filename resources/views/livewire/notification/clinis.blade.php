<div>
    <button id="dropdownNotificationButton" data-dropdown-toggle="dropdownNotification" class=" mr-6 relative inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900 focus:outline-none dark:hover:text-white dark:text-gray-400" type="button">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
        <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/>
        </svg>
        
        <div class="absolute block w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-0.5 start-2.5 dark:border-gray-900"></div>
        </button>
        
        <!-- Dropdown menu -->
        <div id="dropdownNotification" class="max-h-[30rem] overflow-y-auto z-20 hidden w-full max-w-sm bg-white divide-y divide-gray-100 rounded-lg shadow-md dark:bg-gray-800 dark:divide-gray-700" aria-labelledby="dropdownNotificationButton">
          <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
              Notifications
          </div>
          <div class="divide-y divide-gray-100 dark:divide-gray-700">
            @forelse ($notifications as $notif)
                <a class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <div class="flex-shrink-0">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $notif->user )
                            <div class="flex-shrink-0 h-10 w-10"> 
                                <img class="h-10 w-10 rounded-full" src="{{ $notif->user->profile_photo_url }}" alt="{{ $notif->user->name }}"> 
                            </div>
                        @else
                            <div>
                                <div class="text-sm font-medium text-gray-900"> {{ $notif->first_name . " " . $notif->last_name }} </div>
                            </div>
                        @endif
                    </div>
                    <div class="w-full ps-3">
                        <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">{{$notif->description}}</div>
                        <div class="text-xs text-blue-600 dark:text-blue-500">{{\Carbon\Carbon::parse($notif->created_at)->diffForHumans()}}</div>
                    </div>
                </a>
            @empty
            <div class="flex flex-col items-center justify-center">
                <img src="{{ asset('assets/Essentials/No data-cuate.png') }}" alt="" class="h-20 w-20">
                <h1 class="text-xs font-regular mb-2">No results Found</h1>
            </div>
            @endforelse
          </div>
        </div>
</div>
