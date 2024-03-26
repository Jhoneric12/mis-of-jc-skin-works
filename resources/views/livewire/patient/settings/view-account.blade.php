<div>
    <div class="flex gap-4">
        <a href="{{route('settings')}}">
            <x-Essentials.page-title class="text-[#9D9D9D]">Settings</x-Essentials.page-title>
        </a>
        <x-Essentials.page-title class="text-[#9D9D9D]"> > </x-Essentials.page-title>
        <x-Essentials.page-title>Account Details </x-Essentials.page-title>
    </div>

    <div class="flex justify-between gap-4">
        <div class='bg-white border border-solid rounded-lg px-4 py-4 border-t-4 border-t-primary-green border-t-solid shadow-md w-full'>
            <div class="flex justify-between px-6 py-4 border-b-2 border-b-[#D0D0D0] font-bold text-center">
                <div class="flex justify-between gap-4">
                    <h1 class="text-md">Account Details</h1>
                    {{-- <span class="{{ $patient->account_status == false ? 'bg-red-300 text-red-800 text-xs' : 'bg-green-300 text-green-800 text-xs' }} px-2 py-1 rounded-full text-white">
                        {{ $patient->account_status ? 'Active' : 'Inactive'}}
                    </span> --}}
                </div>
            </div>
            <div class="flex justify-center p-4 mt-4">
                <div class="flex flex-col justify-center items-center">
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <div class="flex-shrink-0 h-28 w-28 shadow-lg rounded-full mb-6">
                            <img class="h-28 w-28 rounded-full" src="{{ $patient->profile_photo_url }}" alt="{{ $patient->name }}">
                        </div>
                    @endif
                    <div class='text-sm flex justify-between font-medium'>
                        <h1 class="font-bold text-center text-md">{{$patient->first_name . " " . $patient->middle_name . " " . $patient->last_name}}</h1>
                    </div>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1 class="text-gray-500 font-regular">{{$patient->email}}</h1>
                    </div>
                </div>
            </div>
            <div class=" text-gray">
                <div class='px-6 py-4'>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1>Patient ID</h1>
                        <h1 class="text-gray-500 font-regular">{{$patient->id}}</h1>
                    </div>
                </div>
                <div class='px-6 py-4 border-t border-t-[#D0D0D0]'>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1>Skin Type</h1>
                        <h1 class="text-gray-500 font-regular">{{$patient->skin_type}}</h1>
                    </div>
                </div>
                <div class='px-6 py-4 border-t border-t-[#D0D0D0]'>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1>Gender</h1>
                        <h1 class="text-gray-500 font-regular">{{$patient->gender}}</h1>
                    </div>
                </div>
                <div class='px-6 py-4 border-t border-t-[#D0D0D0]'>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1>Contact Number</h1>
                        <h1 class="text-gray-500 font-regular">{{$patient->contact_number}}</h1>
                    </div>
                </div>
                <div class='px-6 py-4 border-t border-t-[#D0D0D0]'>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1>Birthdate</h1>
                        <h1 class="text-gray-500 font-regular">{{\Carbon\Carbon::parse($patient->birth_date)->format('M, d, Y')}}</h1>
                    </div>
                </div>
                <div class='px-6 py-4 border-t border-t-[#D0D0D0]'>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1>Age</h1>
                        <h1 class="text-gray-500 font-regular">{{$patient->age}}</h1>
                    </div>
                </div>
                <div class='px-6 py-4 border-t border-t-[#D0D0D0]'>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1>Home Address</h1>
                        <h1 class="text-gray-500 font-regular">{{$patient->home_address}}</h1>
                    </div>
                </div>
                <div class='px-6 py-4 border-t border-t-[#D0D0D0]'>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1>Civil Status</h1>
                        <h1 class="text-gray-500 font-regular">{{$patient->civil_status}}</h1>
                    </div>
                </div>
                <div class='px-6 py-4 border-t border-t-[#D0D0D0]'>
                    <div class='text-sm flex justify-between font-medium'>
                        <h1>Religion</h1>
                        <h1 class="text-gray-500 font-regular">{{$patient->religion}}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
