<div>

    <x-Essentials.page-title>Manage Schedule</x-Essentials.page-title>

    {{-- Updated Message --}}
    <x-action-message on="updated" class="w-full text-white bg-green-500 rounded-lg mb-4">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                </svg>
                <p class="mx-3 text-white">Updated successfully.</p>
            </div>
        </div>
    </x-action-message>

    <form wire:submit.prevent='updateSchedule' class='bg-gray-50 p-10 border border-solid border-t-4 border-t-[#5FC26C] border-t-solid shadow-md rounded-lg'>
        @csrf

        <div class="w-1/2 flex justify-between">
            <div>
                <h1 class="font-medium mb-6">Weekly Schedule</h1>
                <!-- Checkbox inputs for each day of the week -->
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                <div class="flex items-center mb-4">
                    <input id="{{ strtolower($day) }}-checkbox" type="checkbox" wire:model="weeklySchedule" value="{{ $day }}" class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="{{ strtolower($day) }}-checkbox" class="ms-2 text-base font-medium text-gray-900 dark:text-gray-300">{{ $day }}</label>
                </div>
                @endforeach
            </div>
            <div>
                <h1 class="font-medium mb-6">Open Time</h1>
                <!-- Input fields for start and end time -->
                <div class="flex gap-2 items-center w-full">
                    <input wire:model="openTime" type="time" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    <span>-</span>
                    <input wire:model="closingTime" type="time" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
            </div>
        </div>

        <div class='flex justify-end mt-6 items-center'>
            <!-- Loading spinner -->
            <div role="status" wire:loading class="mr-2">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading</div>

                    <!-- Submit button -->
                    <button type="submit" class="text-sm text-center bg-[#4FBD5E] hover:opacity-90 text-white px-10 py-3 rounded-[8px]">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
    