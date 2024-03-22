<div class="w-full bg-cover bg-center" style="background-image: url('{{asset('assets/Essentials/desktop-bg.png')}}')">
    <div class="flex justify-around items-center h-screen text-left">
        <div class="lg:w-[40%] w-full flex flex-col items-center md:items-center lg:items-start gap-4">
            <h1 class="text-gray-900 md:text-3xl lg:text-4xl md:text-center lg:text-left text-center text-xl md:leading-[4rem] lg:leading-[3rem] font-extrabold">{{$heroText}}</h1>
            <a href="{{url('register')}}" class="mt-4">
                <x-Essentials.button class="font-semibold">Make Appointment</x-Essentials.button>
            </a>
        </div>
        <div >
            <img src="{{ asset('storage/' . $image) }}" alt="" class="w-[30rem] h-[30rem] hidden md:hidden lg:flex">
        </div>
    </div>
</div>
