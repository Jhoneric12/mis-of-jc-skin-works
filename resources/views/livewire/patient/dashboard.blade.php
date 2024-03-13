<div>
    <x-Essentials.page-title>Home</x-Essentials.page-title>

    <div class="bg-[#B0E1B6] w-full p-12 rounded-lg shadow-lg">
        <h1 class="text-xl font-bold">Welcome {{$patientName}} !</h1>
        <p class="text-sm mt-1 font-regular">Transform Your Skin with JC's Skin Works: Unveiling Radiant Beauty through Expert Care and Tailored Treatments.</p>
    </div>

    {{-- <div class="mt-10">
        <img src="{{asset('assets/Essentials/Services (1).png')}}" alt="">
    </div> --}}

    <div class="flex gap-4 mt-10">
        
        <a href="{{route('appointments')}}" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 p-6">
            <img class="object-cover w-20 rounded-t-lg h-20 md:h-20 md:w-20 md:rounded-none md:rounded-s-lg" src="{{asset('assets/Essentials/Calendar Schedule.png')}}" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white">My Appointments</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm">View your appointments</p>
            </div>
        </a>

        <a href="#" class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 p-6">
            <img class="object-cover w-20 rounded-t-lg h-20 md:h-20 md:w-20 md:rounded-none md:rounded-s-lg" src="{{asset('assets/Essentials/Avatar Doctor.png')}}" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-md font-bold tracking-tight text-gray-900 dark:text-white">Services</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 text-sm">View our services</p>
            </div>
        </a>

</div>
