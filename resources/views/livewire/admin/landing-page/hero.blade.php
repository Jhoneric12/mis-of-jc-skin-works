<div class="w-full bg-cover bg-center bg-gradient-to-tr from-transparent to-[#ebf7dd]">
    <div class="flex justify-around items-center text-left h-screen">
        <div class="lg:w-[40%] w-full flex flex-col items-center md:items-center lg:items-start gap-4">
            <h1 class="text-gray-900 md:text-3xl lg:text-4xl md:text-center lg:text-left text-center text-xl md:leading-[4rem] lg:leading-[3rem] font-extrabold">{{$heroText}}</h1>
            <div class="w-full justify-between hidden lg:flex">
                <div class="first flex gap-2 w-1/2 flex-start">
                    <img src="{{asset('assets/Essentials/calendar-icon.png')}}" alt="" class="w-[1rem] h-[1rem]">
                    <div>
                        <p class="text-sm font-medium">Easy online booking here</p>
                        <p class="text-xs">Make appointment with your doctor anywhere</p>
                    </div>
                </div>
                <div class="first flex gap-2 w-1/2 flex-start">
                    <img src="{{asset('assets/Essentials/medkit.png')}}" alt="" class="w-[1rem] h-[1rem]">
                    <div>
                        <p class="text-sm font-medium">Meet certified dermatologist</p>
                        <p class="text-xs">We always provides what's best for you</p>
                    </div>
                </div>
            </div>
            <a href="{{url('register')}}" class="mt-2">
                <x-Essentials.button class="font-semibold">Make Appointment</x-Essentials.button>
            </a>
        </div>
        <div >
            <img src="{{ asset('storage/' . $image) }}" alt="" class="w-[30rem] h-[30rem] hidden md:hidden lg:flex">
        </div>
    </div>
</div>
