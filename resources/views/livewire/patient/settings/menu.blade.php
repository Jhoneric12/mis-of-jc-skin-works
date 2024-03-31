<div>
    <x-Essentials.page-title>Settings</x-Essentials.page-title>

    <div class="flex flex-col gap-4 mt-6">
        
        <a href="{{route('account-settings')}}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 p-6">
            <img class="object-cover w-20 rounded-t-lg h-20 md:h-20 md:w-20 md:rounded-none md:rounded-s-lg" src="{{asset('assets/Essentials/Profile.png')}}" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white">Account Settings</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm">Edit your account details</p>
            </div>
        </a>

        <a href="{{route('view-account')}}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 p-6">
            <img class="object-cover w-20 rounded-t-lg h-20 md:h-20 md:w-20 md:rounded-none md:rounded-s-lg" src="{{asset('assets/Essentials/personal card.png')}}" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white">View Account Details</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm">View your personal information</p>
            </div>
        </a>
    </div>
</div>
